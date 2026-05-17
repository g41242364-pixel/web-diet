<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Screening;
use App\Models\ScreeningAnswer;
use App\Models\Consultation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkriningController extends Controller
{
    public function langkah1()
    {
        $questions = Question::with('options')->where('fase', 1)->orderBy('urutan')->get();
        return view('pengguna.skrining_langkah_1', compact('questions'));
    }

    public function langkah1Simpan(Request $request)
    {
        $questions = Question::where('fase', 1)->get();
        $jawaban = [];

        foreach ($questions as $q) {
            $key = 'q_' . $q->id;
            if (!$request->has($key)) {
                return back()->with('error', 'Semua pertanyaan wajib dijawab.')->withInput();
            }
            $jawaban[$q->id] = $request->input($key);
        }

        session(['skrining_jawaban_fase1' => $jawaban]);
        return redirect()->route('skrining.langkah2');
    }

    public function langkah2()
    {
        if (!session('skrining_jawaban_fase1')) {
            return redirect()->route('skrining.langkah1')->with('error', 'Silakan isi kuisioner fase 1 terlebih dahulu.');
        }

        $questions = Question::with('options')->where('fase', 2)->orderBy('urutan')->get();
        return view('pengguna.skrining_langkah_2', compact('questions'));
    }

    public function langkah2Simpan(Request $request)
    {
        $questions = Question::where('fase', 2)->get();
        $jawaban = [];

        foreach ($questions as $q) {
            $key = 'q_' . $q->id;
            if (!$request->has($key)) {
                return back()->with('error', 'Semua pertanyaan wajib dijawab.')->withInput();
            }
            $jawaban[$q->id] = $request->input($key);
        }

        session(['skrining_jawaban_fase2' => $jawaban]);
        return redirect()->route('skrining.langkah3');
    }

    public function langkah3()
    {
        if (!session('skrining_jawaban_fase1') || !session('skrining_jawaban_fase2')) {
            return redirect()->route('skrining.langkah1')->with('error', 'Silakan isi kuisioner terlebih dahulu.');
        }

        return view('pengguna.skrining_langkah_3');
    }

    public function langkah3Simpan(Request $request)
    {
        $request->validate([
            'berat_badan' => 'required|numeric|min:10|max:500',
            'tinggi_badan' => 'required|numeric|min:50|max:300',
        ], [
            'berat_badan.required' => 'Berat badan wajib diisi.',
            'berat_badan.numeric'  => 'Berat badan harus berupa angka.',
            'tinggi_badan.required' => 'Tinggi badan wajib diisi.',
            'tinggi_badan.numeric' => 'Tinggi badan harus berupa angka.',
        ]);

        $berat  = $request->berat_badan;
        $tinggi = $request->tinggi_badan;

        $tinggi_meter = $tinggi / 100;
        $imt          = round($berat / ($tinggi_meter * $tinggi_meter), 2);
        $status_imt   = $this->hitungStatusIMT($imt);

        $jawaban_fase1 = session('skrining_jawaban_fase1', []);
        $jawaban_fase2 = session('skrining_jawaban_fase2', []);
        $semua_jawaban = $jawaban_fase1 + $jawaban_fase2;

        // itung skor kebiasaan (a=1, b=2, c=3, d=4 sesuai urutan)
        $total_skor = 0;
        foreach ($semua_jawaban as $question_id => $option_id) {
            $option = \App\Models\QuestionOption::find($option_id);
            if ($option) {
                $total_skor += $option->skor;
            }
        }

        $status_kebiasaan = $this->hitungStatusKebiasaan($total_skor);

        $screening = Screening::create([
            'user_id'          => Auth::id(),
            'berat_badan'      => $berat,
            'tinggi_badan'     => $tinggi,
            'imt'              => $imt,
            'status_imt'       => $status_imt,
            'total_skor'       => $total_skor,
            'status_kebiasaan' => $status_kebiasaan,
        ]);

        foreach ($semua_jawaban as $question_id => $option_id) {
            ScreeningAnswer::create([
                'screening_id'      => $screening->id,
                'question_id'       => $question_id,
                'question_option_id' => $option_id,
            ]);
        }

        // Bersihkan session
        session()->forget(['skrining_jawaban_fase1', 'skrining_jawaban_fase2']);

        return view('pengguna.skrining_langkah_4', compact('screening', 'imt', 'status_imt', 'total_skor', 'status_kebiasaan'));
    }

    public function lanjutKonsultasi(Request $request, $screening_id)
    {
        $screening = Screening::findOrFail($screening_id);

        $ahliGizi = User::where('role', 'ahli_gizi')
            ->where('is_online', true)
            ->first();

        if (!$ahliGizi) {
            $imt              = $screening->imt;
            $status_imt       = $screening->status_imt;
            $total_skor       = $screening->total_skor;
            $status_kebiasaan = $screening->status_kebiasaan;
            $error            = 'Tidak ada ahli gizi yang sedang online. Coba lagi nanti.'; // ✅

            return view('pengguna.skrining_langkah_4', compact(
                'screening',
                'imt',
                'status_imt',
                'total_skor',
                'status_kebiasaan',
                'error'
            ));
        }

        $consultation = Consultation::create([
            'user_id'      => Auth::id(),
            'ahli_gizi_id' => $ahliGizi->id,
            'status'       => 'aktif',
            'screening_id' => $screening->id,
        ]);

        $isiPesan  = "Halo, saya ingin berkonsultasi.\n\n";
        $isiPesan .= "**Hasil Skrining Saya:**\n";
        $isiPesan .= "- Berat Badan: {$screening->berat_badan} kg\n";
        $isiPesan .= "- Tinggi Badan: {$screening->tinggi_badan} cm\n";
        $isiPesan .= "- Nilai IMT: {$screening->imt}\n";
        $isiPesan .= "- Status IMT: {$screening->status_imt}\n";
        $isiPesan .= "- Total Skor Kebiasaan: {$screening->total_skor}\n";
        $isiPesan .= "- Status Kebiasaan: {$screening->status_kebiasaan}\n";

        Message::create([
            'consultation_id' => $consultation->id,
            'user_id'         => Auth::id(),
            'isi'             => $isiPesan,
        ]);

        return redirect()->route('pengguna.konsultasi.chat', $consultation->id)
            ->with('success', 'Konsultasi berhasil dibuat. Ahli gizi akan segera merespons.');
    }


    private function hitungStatusIMT($imt)
    {
        if ($imt < 18.5)  return 'Underweight';
        if ($imt < 23.0)  return 'Normal';
        if ($imt < 25.0)  return 'Overweight';
        if ($imt < 30.0)  return 'Obesitas 1';
        return 'Obesitas 2';
    }

    private function hitungStatusKebiasaan($skor)
    {
        if ($skor <= 17) return 'Hidup Sehat';
        if ($skor <= 25) return 'Cukup Sehat';
        if ($skor <= 32) return 'Kurang Sehat';
        return 'Tidak Sehat';
    }
}
