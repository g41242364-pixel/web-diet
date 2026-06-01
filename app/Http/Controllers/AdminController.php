<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Screening;
use App\Models\Consultation;
use App\Models\Food;
use App\Models\PhysicalActivity;
use App\Models\TargetDiet;
use App\Models\SleepLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ============ DASHBOARD ============

    public function dashboard()
    {
        $totalPengguna = User::where('role', 'pengguna')->count();
        $totalAhliGizi = User::where('role', 'ahli_gizi')->count();
        $totalSkrining = Screening::count();
        $totalKonsultasi = Consultation::count();

        $distribusiImt = Screening::selectRaw('status_imt, count(*) as total')
            ->groupBy('status_imt')
            ->pluck('total', 'status_imt');

        return view('admin.dashboard', compact(
            'totalPengguna',
            'totalAhliGizi',
            'totalSkrining',
            'totalKonsultasi',
            'distribusiImt'
        ));
    }

    // ============ SKRINING ============

    public function daftarSkrining()
    {
        $screenings = Screening::with('user')->latest()->paginate(15);
        return view('admin.daftar_skrining', compact('screenings'));
    }

    // ============ TARGET DIET ============

    public function daftarTargetDiet()
    {
        $targets = TargetDiet::with(['user', 'checkins'])->latest()->paginate(15);
        return view('admin.daftar_target_diet', compact('targets'));
    }

    // ============ POLA TIDUR ============

    public function daftarPolaTidur()
    {
        $sleepLogs = SleepLog::with('user')->latest()->paginate(15);
        return view('admin.daftar_pola_tidur', compact('sleepLogs'));
    }

    // ============ MAKANAN (CRUD) ============

    public function kelolaJurnalMakanan()
    {
        $foods = Food::latest()->paginate(15);
        return view('admin.kelola_jurnal_makanan', compact('foods'));
    }

    public function simpanMakanan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kalori' => 'required|numeric|min:0',
            'protein' => 'required|numeric|min:0',
            'karbohidrat' => 'required|numeric|min:0',
            'lemak' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $namaFile = null;

        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');

            // nama unik file
            $namaFile = time() . '_' . $file->getClientOriginalName();

            // folder tujuan
            $tujuan = public_path('assets/images/makanan');

            // buat folder jika belum ada
            if (!File::exists($tujuan)) {
                File::makeDirectory($tujuan, 0755, true);
            }

            // pindahkan file
            $file->move($tujuan, $namaFile);
        }

        Food::create([
            'nama' => $request->nama,
            'kalori' => $request->kalori,
            'protein' => $request->protein,
            'karbohidrat' => $request->karbohidrat,
            'lemak' => $request->lemak,
            'gambar' => $namaFile,
        ]);

        return back()->with('success', 'Makanan berhasil ditambahkan.');
    }

    public function updateMakanan(Request $request, $id)
    {
        $food = Food::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kalori' => 'required|numeric|min:0',
            'protein' => 'required|numeric|min:0',
            'karbohidrat' => 'required|numeric|min:0',
            'lemak' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $namaFile = $food->gambar;

        if ($request->hasFile('gambar')) {

            // hapus gambar lama
            if ($food->gambar) {

                $pathLama = public_path('assets/images/makanan/' . $food->gambar);

                if (File::exists($pathLama)) {
                    File::delete($pathLama);
                }
            }

            $file = $request->file('gambar');

            // nama unik file
            $namaFile = time() . '_' . $file->getClientOriginalName();

            // folder tujuan
            $tujuan = public_path('assets/images/makanan');

            // buat folder jika belum ada
            if (!File::exists($tujuan)) {
                File::makeDirectory($tujuan, 0755, true);
            }

            // pindahkan file
            $file->move($tujuan, $namaFile);
        }

        $food->update([
            'nama' => $request->nama,
            'kalori' => $request->kalori,
            'protein' => $request->protein,
            'karbohidrat' => $request->karbohidrat,
            'lemak' => $request->lemak,
            'gambar' => $namaFile,
        ]);

        return back()->with('success', 'Makanan berhasil diperbarui.');
    }

    public function hapusMakanan($id)
    {
        $food = Food::findOrFail($id);

        // hapus file gambar
        if ($food->gambar) {

            $path = public_path('assets/images/makanan/' . $food->gambar);

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $food->delete();

        return back()->with('success', 'Makanan berhasil dihapus.');
    }

    // ============ AKTIVITAS FISIK (CRUD) ============

    public function kelolaAktivitasFisik()
    {
        $aktivitas = PhysicalActivity::latest()->paginate(15);

        return view('admin.kelola_aktivitas_fisik', compact('aktivitas'));
    }

    public function simpanAktivitas(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status_kebiasaan' => 'required|string|max:255',
            'durasi' => 'required|string|max:255',
            'intensitas' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'link_youtube' => 'nullable|string',
        ]);

        PhysicalActivity::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'status_kebiasaan' => $request->status_kebiasaan,
            'durasi' => $request->durasi,
            'intensitas' => $request->intensitas,
            'lokasi' => $request->lokasi,
            'link_youtube' => $request->link_youtube,
        ]);

        return back()->with('success', 'Aktivitas berhasil ditambahkan.');
    }

    public function updateAktivitas(Request $request, $id)
    {
        $aktivitas = PhysicalActivity::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status_kebiasaan' => 'required|string|max:255',
            'durasi' => 'required|string|max:255',
            'intensitas' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'link_youtube' => 'nullable|string',
        ]);

        $aktivitas->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'status_kebiasaan' => $request->status_kebiasaan,
            'durasi' => $request->durasi,
            'intensitas' => $request->intensitas,
            'lokasi' => $request->lokasi,
            'link_youtube' => $request->link_youtube,
        ]);

        return back()->with('success', 'Aktivitas berhasil diperbarui.');
    }

    public function hapusAktivitas($id)
    {
        $aktivitas = PhysicalActivity::findOrFail($id);
        $aktivitas->delete();
        return back()->with('success', 'Aktivitas berhasil dihapus.');
    }
    // ============ KELOLA PENGGUNA ============

    public function kelolaPengguna(Request $request)
    {
        $query = User::where('role', 'pengguna');

        // fitur search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(5);

        return view('admin.kelola_pengguna', compact('users'));
    }

    public function store_pengguna(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'jenis_kelamin' => 'required|string',
            'umur' => 'required|integer|min:1',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengguna',        // Diisi otomatis sistem
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'is_online' => false,       // Default status offline
        ]);

        return redirect()->back()->with('success', 'Akun Pengguna baru berhasil didaftarkan.');
    }


    public function updatePengguna(Request $request, $id)
    {
        $user = User::where('role', 'pengguna')->findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'umur' => 'required|numeric|min:1',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
        ]);

        return back()->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function hapusPengguna($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }

    // ============ KELOLA AHLI GIZI ============

    public function kelolaAhliGizi(Request $request)
    {
        $query = User::where('role', 'ahli_gizi');

        // search
        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->paginate(5);

        return view('admin.kelola_ahli_gizi', compact('users'));
    }

    public function store_ahli_gizi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'jenis_kelamin' => 'required|string',
            'umur' => 'required|integer|min:1',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'ahli_gizi', // Diisi otomatis sistem
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'is_online' => false,  // Default status offline
        ]);

        return redirect()->back()->with('success', 'Akun Ahli Gizi baru berhasil didaftarkan.');
    }

    public function updateAhliGizi(Request $request, $id)
    {
        $user = User::where('role', 'ahli_gizi')->findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'umur' => 'required|numeric|min:1',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
        ]);

        return back()->with('success', 'Data ahli gizi berhasil diperbarui.');
    }


    public function hapusAhliGizi($id)
    {
        $user = User::where('role', 'ahli_gizi')->findOrFail($id);

        $user->delete();

        return back()->with('success', 'Ahli gizi berhasil dihapus.');
    }
}
