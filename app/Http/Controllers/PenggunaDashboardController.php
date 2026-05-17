<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use App\Models\TargetDiet;
use App\Models\SleepLog;
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;

class PenggunaDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $skriningTerakhir = Screening::where('user_id', $user->id)
            ->latest()
            ->first();

        $targetDiet = TargetDiet::where('user_id', $user->id)
            ->latest()
            ->first();

        $sleepLogTerakhir = SleepLog::where('user_id', $user->id)
            ->latest('tanggal')
            ->first();

        $konsultasiTerakhir = Consultation::where('user_id', $user->id)
            ->with([
                'messages' => fn($q) => $q->latest()->limit(1),
                'ahliGizi'
            ])
            ->latest()
            ->first();

        $statusKebiasaan = 'Belum Ada Data';

        if ($skriningTerakhir) {
            $statusKebiasaan = $skriningTerakhir->status_kebiasaan ?? 'Belum Ada Data';
        }

        return view('pengguna.dashboard', compact(
            'skriningTerakhir',
            'targetDiet',
            'sleepLogTerakhir',
            'konsultasiTerakhir',
            'statusKebiasaan'
        ));
    }
}
