<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use App\Models\TargetDiet;
use App\Models\Consultation;
use App\Models\Food;
use App\Models\MealPlan;
use App\Models\MealPlanItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AhliGiziController extends Controller
{
    // ============ DASHBOARD ============

    public function dashboard()
    {
        $ahliGizi = Auth::user();

        $totalPasien = Consultation::where('ahli_gizi_id', $ahliGizi->id)
            ->distinct('user_id')->count('user_id');

        $totalSkrining = Screening::count();

        $konsultasiAktif = Consultation::where('ahli_gizi_id', $ahliGizi->id)
            ->where('status', 'aktif')->count();

        $distribusiImt = Screening::selectRaw('status_imt, count(*) as total')
            ->groupBy('status_imt')
            ->pluck('total', 'status_imt');

        $progressDiet = TargetDiet::whereHas('user.consultations', function ($q) use ($ahliGizi) {
            $q->where('ahli_gizi_id', $ahliGizi->id);
        })->with(['user', 'checkins'])->take(5)->get();

        return view('ahli_gizi.dashboard', compact(
            'totalPasien',
            'totalSkrining',
            'konsultasiAktif',
            'distribusiImt',
            'progressDiet'
        ));
    }

    // ============ STATUS ONLINE/OFFLINE ============

    public function toggleStatus()
    {
        $user = Auth::user();
        $user->update(['is_online' => !$user->is_online]);

        $status = $user->is_online ? 'Online' : 'Offline';
        return back()->with('success', "Status berhasil diubah menjadi $status.");
    }

    // ============ SKRINING ============

    public function daftarSkrining()
    {
        $userIds = Consultation::where('ahli_gizi_id', Auth::id())
            ->pluck('user_id');

        $screenings = Screening::whereIn('user_id', $userIds)
            ->with('user')
            ->latest()
            ->paginate(15);

        return view('ahli_gizi.daftar_skrining', compact('screenings'));
    }

    // ============ TARGET DIET ============

    public function daftarTargetDiet(Request $request)
    {
        $search = $request->get('search');

        $userIds = \App\Models\Consultation::where('ahli_gizi_id', Auth::id())
            ->pluck('user_id');

        $query = \App\Models\TargetDiet::whereIn('user_id', $userIds)
            ->with(['user', 'checkins']);

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        $targets = $query->latest()->paginate(15);

        if ($request->ajax()) {
            return view('ahli_gizi.partials._target_diet_cards', compact('targets'))->render();
        }

        return view('ahli_gizi.daftar_target_diet', compact('targets'));
    }

    // ============ JURNAL MAKANAN (Ahli Gizi buat rekomendasi) ============

    public function jurnalMakanan()
    {
        $foods = Food::all();
        $kategoris = ['sarapan', 'makan_siang', 'makan_malam', 'camilan'];
        $statusImtOptions = ['Underweight', 'Normal', 'Overweight', 'Obesitas 1', 'Obesitas 2'];

        $mealPlans = MealPlan::where('user_id', Auth::id())
            ->with('items.food')
            ->latest()
            ->paginate(10);

        return view('ahli_gizi.jurnal_makanan', compact('foods', 'kategoris', 'statusImtOptions', 'mealPlans'));
    }

    public function simpanJurnalMakanan(Request $request)
    {
        $request->validate([
            'status_imt' => 'required|',
            'kategori' => 'required|in:sarapan,makan_siang,makan_malam,camilan',
            'food_ids' => 'required|array|min:1',
            'food_ids.*' => 'exists:foods,id',
        ], [
            'status_imt.required' => 'Status IMT wajib dipilih.',
            'kategori.required' => 'Kategori makan wajib dipilih.',
            'food_ids.required' => 'Pilih minimal 1 makanan.',
        ]);

        $foods = Food::whereIn('id', $request->food_ids)->get();

        $mealPlan = MealPlan::create([
            'user_id' => Auth::id(),
            'status_imt' => $request->status_imt,
            'kategori' => $request->kategori,
            'tanggal' => Carbon::today(),
            'total_kalori' => $foods->sum('kalori'),
            'total_protein' => $foods->sum('protein'),
            'total_karbohidrat' => $foods->sum('karbohidrat'),
            'total_lemak' => $foods->sum('lemak'),
        ]);

        foreach ($request->food_ids as $food_id) {
            MealPlanItem::create([
                'meal_plan_id' => $mealPlan->id,
                'food_id' => $food_id,
                'porsi' => 1,
            ]);
        }

        return back()->with('success', 'Jurnal makanan berhasil disimpan.');
    }


    public function updateJurnalMakanan(Request $request, $id)
    {
        $request->validate([
            'status_imt' => 'required',
            'kategori' => 'required|in:sarapan,makan_siang,makan_malam,camilan',
            'food_ids' => 'required|array|min:1',
            'food_ids.*' => 'exists:foods,id',
        ], [
            'status_imt.required' => 'Status IMT wajib dipilih.',
            'kategori.required' => 'Kategori makan wajib dipilih.',
            'food_ids.required' => 'Pilih minimal 1 makanan.',
        ]);

        $mealPlan = MealPlan::findOrFail($id);
        $foods = Food::whereIn('id', $request->food_ids)->get();

        // Update data utama rencana makan
        $mealPlan->update([
            'status_imt' => $request->status_imt,
            'kategori' => $request->kategori,
            'total_kalori' => $foods->sum('kalori'),
            'total_protein' => $foods->sum('protein'),
            'total_karbohidrat' => $foods->sum('karbohidrat'),
            'total_lemak' => $foods->sum('lemak'),
        ]);

        // Bersihkan dan masukkan ulang item detail
        MealPlanItem::where('meal_plan_id', $mealPlan->id)->delete();

        foreach ($request->food_ids as $food_id) {
            MealPlanItem::create([
                'meal_plan_id' => $mealPlan->id,
                'food_id' => $food_id,
                'porsi' => 1,
            ]);
        }

        return back()->with('success', 'Rekomendasi jurnal makanan berhasil diperbarui.');
    }

    /**
     * Menghapus rekomendasi jurnal makanan dari sistem.
     */
    public function hapusJurnalMakanan($id)
    {
        $mealPlan = MealPlan::findOrFail($id);

        // Hapus item rencana makan terlebih dahulu untuk menjaga relasi data
        MealPlanItem::where('meal_plan_id', $mealPlan->id)->delete();
        $mealPlan->delete();

        return back()->with('success', 'Rekomendasi jurnal makanan berhasil dihapus.');
    }
}
