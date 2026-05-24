<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\MealPlan;
use App\Models\Consultation;
use App\Models\Screening;
use Illuminate\Support\Facades\Auth;

class JurnalMakananController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil skrining terakhir user
        $skriningTerakhir = Screening::where('user_id', $user->id)
            ->latest()
            ->first();

        // Ambil status IMT
        $statusImt = $skriningTerakhir
            ? $skriningTerakhir->status_imt
            : null;

        // Ambil konsultasi aktif
        $konsultasiAktif = Consultation::where('user_id', $user->id)
            ->where('status', 'aktif')
            ->latest()
            ->first();

        // Default mealPlans kosong
        $mealPlans = collect();

        // Jika ada konsultasi aktif dan status IMT
        if ($konsultasiAktif && $statusImt) {

            $ahliGiziId = $konsultasiAktif->ahli_gizi_id;

            $mealPlans = MealPlan::where('user_id', $ahliGiziId)
                ->where('status_imt', $statusImt)
                ->with('items.food')
                ->latest()
                ->get()
                ->groupBy('kategori');
        }

        // TAMBAHAN INI
        $foods = Food::paginate(9);

        // Kirim semua data ke blade
        return view('pengguna.rekomendasi_jurnal_makanan', compact(
            'statusImt',
            'mealPlans',
            'skriningTerakhir',
            'konsultasiAktif',
            'foods'
        ));
    }

    // DETAIL MAKANAN
    public function detail($id)
    {
        $plan = MealPlan::with('items.food')->findOrFail($id);

        return view(
            'pengguna.detail_makanan',
            compact('plan')
        );
    }

    // HALAMAN MAKANAN LAINNYA
    public function lainnya()
    {
        $foods = Food::paginate(9);

        return view(
            'pengguna.jurnal_makanan',
            compact('foods')
        );
    }
}
