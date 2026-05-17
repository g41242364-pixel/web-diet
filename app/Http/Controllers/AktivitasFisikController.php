<?php

namespace App\Http\Controllers;

use App\Models\PhysicalActivity;
use App\Models\Screening;
use Illuminate\Support\Facades\Auth;

class AktivitasFisikController extends Controller
{
    public function index()
    {
        $skriningTerakhir = Screening::where('user_id', Auth::id())
            ->latest()
            ->first();

        $query = PhysicalActivity::query();

        if ($skriningTerakhir) {
            $query->where('status_kebiasaan', $skriningTerakhir->status_kebiasaan);
        }

        $aktivitas = $query->paginate(6);

        return view('pengguna.rekomendasi_aktivitas_fisik', compact('aktivitas', 'skriningTerakhir'));
    }

    public function detail($id)
    {
        $act = PhysicalActivity::findOrFail($id);
        return view('pengguna.aktivitas_fisik_detail', compact('act'));
    }

    public function aktivitas_all()
    {
        $aktivitas = PhysicalActivity::paginate(6);

        return view('pengguna.aktivitas_fisik', compact('aktivitas'));
    }
}
