<?php

namespace App\Http\Controllers;

use App\Models\TargetDiet;
use App\Models\DietCheckin;
use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TargetDietController extends Controller
{
    public function index()
    {
        $user             = Auth::user();
        $targetDiet       = TargetDiet::where('user_id', $user->id)->latest()->first();
        $skriningTerakhir = Screening::where('user_id', $user->id)->latest()->first();
        $checkins         = $targetDiet ? $targetDiet->checkins()->take(10)->get() : collect();
        $checkinTerakhir  = $targetDiet ? $targetDiet->checkins()->latest('tanggal_checkin')->first() : null;

        $bolehCheckin = true;
        if ($checkinTerakhir) {
            $selisihHari  = Carbon::parse($checkinTerakhir->tanggal_checkin)->diffInDays(Carbon::today());
            $bolehCheckin = $selisihHari >= 7;
        }

        $progressAktif = 0;
        if ($targetDiet && $targetDiet->berat_awal && $checkinTerakhir) {
            $diff          = abs($targetDiet->berat_awal - $targetDiet->berat_target);
            $actual        = abs($targetDiet->berat_awal - $checkinTerakhir->berat_sekarang);
            $progressAktif = $diff > 0 ? min(100, round(($actual / $diff) * 100)) : 0;
        }

        $targetTercapai = $progressAktif >= 100;

        return view('pengguna.target_diet', compact(
            'targetDiet', 'skriningTerakhir', 'checkins',
            'bolehCheckin', 'checkinTerakhir', 'progressAktif', 'targetTercapai'
        ));
    }

    public function simpanTarget(Request $request)
    {
        $request->validate([
            'berat_target'    => 'required|numeric|min:10|max:500',
            'target_mingguan' => 'required|numeric|min:0.1|max:5',
            'tujuan'          => 'required|in:turun,naik,jaga',
            'berat_awal'      => 'nullable|numeric|min:10|max:500',
        ], [
            'berat_target.required'    => 'Target berat badan wajib diisi.',
            'target_mingguan.required' => 'Target mingguan wajib diisi.',
            'tujuan.required'          => 'Tujuan wajib dipilih.',
        ]);

        $targetAktif = TargetDiet::where('user_id', Auth::id())->latest()->first();

        if ($targetAktif) {
            $progress       = 0;
            $checkinTerbaru = $targetAktif->checkins()->latest('tanggal_checkin')->first();

            if ($targetAktif->berat_awal && $checkinTerbaru) {
                $diff     = abs($targetAktif->berat_awal - $targetAktif->berat_target);
                $actual   = abs($targetAktif->berat_awal - $checkinTerbaru->berat_sekarang);
                $progress = $diff > 0 ? min(100, round(($actual / $diff) * 100)) : 0;
            }

            if ($progress < 100) {
                return back()->with('error', 'Target diet saat ini belum tercapai (progres ' . $progress . '%). Selesaikan target lama sebelum membuat target baru.');
            }
        }

        TargetDiet::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'berat_target'    => $request->berat_target,
                'target_mingguan' => $request->target_mingguan,
                'tujuan'          => $request->tujuan,
                'berat_awal'      => $request->berat_awal,
            ]
        );

        return back()->with('success', 'Target diet berhasil disimpan.');
    }

    public function checkin(Request $request)
    {
        $request->validate([
            'berat_sekarang' => 'required|numeric|min:10|max:500',
            'catatan'        => 'nullable|string|max:500',
        ], [
            'berat_sekarang.required' => 'Berat badan saat ini wajib diisi.',
        ]);

        $targetDiet = TargetDiet::where('user_id', Auth::id())->latest()->first();

        if (!$targetDiet) {
            return back()->with('error', 'Silakan buat target diet terlebih dahulu.');
        }

        // Cek 7 hari
        $checkinTerakhir = $targetDiet->checkins()->latest('tanggal_checkin')->first();
        if ($checkinTerakhir) {
            $selisihHari = Carbon::parse($checkinTerakhir->tanggal_checkin)->diffInDays(Carbon::today());
            if ($selisihHari < 7) {
                $sisaHari = 7 - $selisihHari;
                return back()->with('error', "Check-in hanya bisa dilakukan setiap 7 hari. Sisa $sisaHari hari lagi.");
            }
        }

        DietCheckin::create([
            'user_id'        => Auth::id(),
            'target_diet_id' => $targetDiet->id,
            'berat_sekarang' => $request->berat_sekarang,
            'catatan'        => $request->catatan,
            'tanggal_checkin'=> Carbon::today(),
        ]);

        return back()->with('success', 'Check-in berhasil dicatat!');
    }
}
