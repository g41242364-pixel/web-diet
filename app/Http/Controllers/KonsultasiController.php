<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    public function index()
    {
        $consultations = Consultation::where('user_id', Auth::id())
            ->with('ahliGizi', 'messages')
            ->latest()
            ->get();

        return view('pengguna.konsultasi', compact('consultations'));
    }

    public function chat($id)
    {
        $consultation = Consultation::with(['messages.sender', 'ahliGizi', 'user', 'screening'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pengguna.konsultasi_chat', compact('consultation'));
    }

    public function kirimPesan(Request $request, $id)
    {
        $request->validate(['isi' => 'required|string|max:2000'], [
            'isi.required' => 'Pesan tidak boleh kosong.',
        ]);

        $consultation = Consultation::where('user_id', Auth::id())->findOrFail($id);

        Message::create([
            'consultation_id' => $consultation->id,
            'user_id' => Auth::id(),
            'isi' => $request->isi,
        ]);

        return back();
    }

    // ============ AHLI GIZI ============

    public function indexAhliGizi(Request $request)
    {
        $search = $request->search;

        $consultations = Consultation::where('ahli_gizi_id', Auth::id())
            ->with(['user', 'messages.sender', 'screening'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->get();

        $activeConsultation = null;

        if ($request->chat) {
            $activeConsultation = Consultation::with([
                'messages.sender',
                'user',
                'screening'
            ])
                ->where('ahli_gizi_id', Auth::id())
                ->findOrFail($request->chat);
        }

        return view('ahli_gizi.konsultasi', compact(
            'consultations',
            'activeConsultation'
        ));
    }
    public function chatAhliGizi($id)
    {
        $consultation = Consultation::with(['messages.sender', 'user', 'screening'])
            ->where('ahli_gizi_id', Auth::id())
            ->findOrFail($id);

        return view('ahli_gizi.konsultasi_chat', compact('consultation'));
    }

    public function balasPesan(Request $request, $id)
    {
        $request->validate(['isi' => 'required|string|max:2000'], [
            'isi.required' => 'Pesan tidak boleh kosong.',
        ]);

        $consultation = Consultation::where('ahli_gizi_id', Auth::id())->findOrFail($id);

        Message::create([
            'consultation_id' => $consultation->id,
            'user_id' => Auth::id(),
            'isi' => $request->isi,
        ]);

        return back();
    }

    public function selesaikan($id)
    {
        $consultation = Consultation::where('ahli_gizi_id', Auth::id())->findOrFail($id);
        $consultation->update(['status' => 'selesai']);
        return back()->with('success', 'Konsultasi telah diselesaikan.');
    }
    public function hapus($id)
    {
        $consultation = Consultation::where('ahli_gizi_id', Auth::id())
            ->findOrFail($id);

        $consultation->messages()->delete();

        $consultation->delete();

        return redirect()
            ->route('ahligizi.konsultasi')
            ->with('success', 'Chat berhasil dihapus.');
    }
}
