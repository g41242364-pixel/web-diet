<?php

namespace App\Http\Controllers;

use App\Models\SleepLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PolaTidurController extends Controller
{
    public function index()
    {
        $sleepLogs = SleepLog::where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->take(7)
            ->get();

        return view('pengguna.pola_tidur', compact('sleepLogs'));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'jam_tidur' => 'required',
            'jam_bangun' => 'required',
            'catatan' => 'nullable|string|max:500',
        ], [
            'jam_tidur.required' => 'Jam tidur wajib diisi.',
            'jam_bangun.required' => 'Jam bangun wajib diisi.',
        ]);

        $tidur = Carbon::createFromTimeString($request->jam_tidur);
        $bangun = Carbon::createFromTimeString($request->jam_bangun);

        if ($bangun->lt($tidur)) {
            $bangun->addDay();
        }

        $durasiJam = $tidur->diffInMinutes($bangun) / 60;
        $durasiJam = round($durasiJam, 2);

        if ($durasiJam < 6) {
            $status = 'Kurang';
        } elseif ($durasiJam <= 9) {
            $status = 'Baik';
        } else {
            $status = 'Berlebih';
        }

        SleepLog::create([
            'user_id' => Auth::id(),
            'jam_tidur' => $request->jam_tidur,
            'jam_bangun' => $request->jam_bangun,
            'durasi_jam' => $durasiJam,
            'status_tidur' => $status,
            'catatan' => $request->catatan,
            'tanggal' => Carbon::today(),
        ]);

        return back()->with('success', 'Pola tidur berhasil dicatat.');
    }
}
