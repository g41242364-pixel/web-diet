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

        $skriningTerakhir = Screening::where('user_id', $user->id)
            ->latest()
            ->first();

        $statusImt = $skriningTerakhir
            ? $skriningTerakhir->status_imt
            : null;

        $konsultasiAktif = Consultation::where('user_id', $user->id)
            ->where('status', 'aktif')
            ->latest()
            ->first();

        $mealPlans = collect();

        if ($konsultasiAktif && $statusImt) {

            $ahliGiziId = $konsultasiAktif->ahli_gizi_id;

            $mealPlans = MealPlan::where('user_id', $ahliGiziId)
                ->where('status_imt', $statusImt)
                ->with('items.food')
                ->latest()
                ->get()
                ->groupBy('kategori');
        }

        return view('pengguna.rekomendasi_jurnal_makanan', compact(
            'statusImt',
            'mealPlans',
            'skriningTerakhir',
            'konsultasiAktif'
        ));
    }

    public function detail($id)
    {
        $plan = MealPlan::with('items.food')->findOrFail($id);
        return view('pengguna.detail_makanan', compact('plan'));
    }

public function lainnya()
{
    $foods = Food::paginate(6);

    return view('pengguna.jurnal_makanan', compact('foods'));
}
    }
    