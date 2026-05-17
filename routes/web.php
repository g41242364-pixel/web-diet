<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PenggunaDashboardController;
use App\Http\Controllers\SkriningController;
use App\Http\Controllers\TargetDietController;
use App\Http\Controllers\JurnalMakananController;
use App\Http\Controllers\PolaTidurController;
use App\Http\Controllers\AktivitasFisikController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AhliGiziController;

// ============ AUTH ============
Route::middleware('guest')->group(function () {
    Route::get('/login',          [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',         [AuthController::class, 'login'])->name('login.post');
    Route::get('/register',       [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',      [AuthController::class, 'register'])->name('register.post');
    Route::get('/lupa-password',  [AuthController::class, 'showLupaPassword'])->name('lupa.password');
    Route::post('/lupa-password', [AuthController::class, 'lupaPassword'])->name('lupa.password.post');
    Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('reset.password.form');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset.password.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============ PENGGUNA ============
Route::middleware(['auth', 'role:pengguna'])->group(function () {

    Route::get('/',          [PenggunaDashboardController::class, 'index'])->name('pengguna.dashboard');
    Route::get('/dashboard', [PenggunaDashboardController::class, 'index']);

    Route::get('/skrining',                    [SkriningController::class, 'langkah1'])->name('skrining.langkah1');
    Route::get('/skrining-langkah-1',          [SkriningController::class, 'langkah1']);
    Route::post('/skrining/langkah-1',         [SkriningController::class, 'langkah1Simpan'])->name('skrining.langkah1.simpan');

    Route::get('/skrining-langkah-2',          [SkriningController::class, 'langkah2'])->name('skrining.langkah2');
    Route::post('/skrining/langkah-2',         [SkriningController::class, 'langkah2Simpan'])->name('skrining.langkah2.simpan');

    Route::get('/skrining-langkah-3',  [SkriningController::class, 'langkah3'])->name('skrining.langkah3');
    Route::get('/skrining/langkah-3',  [SkriningController::class, 'langkah3']);
    Route::post('/skrining/langkah-3', [SkriningController::class, 'langkah3Simpan'])->name('skrining.langkah3.simpan');


    Route::post('/skrining/{screening_id}/lanjut-konsultasi', [SkriningController::class, 'lanjutKonsultasi'])->name('skrining.lanjutKonsultasi');

    Route::get('/target-diet',           [TargetDietController::class, 'index'])->name('pengguna.targetDiet');
    Route::post('/target-diet/simpan',   [TargetDietController::class, 'simpanTarget'])->name('pengguna.targetDiet.simpan');
    Route::post('/target-diet/checkin',  [TargetDietController::class, 'checkin'])->name('pengguna.targetDiet.checkin');

    Route::prefix('jurnal-makanan')->group(function () {
        Route::get('/rekomendasi-jurnal-makanan', [JurnalMakananController::class, 'index'])->name('pengguna.jurnalMakanan');
        Route::get('/rekomendasi',                [JurnalMakananController::class, 'index']);
        Route::get('/detail/{id}',               [JurnalMakananController::class, 'detail'])->name('pengguna.jurnalMakanan.detail');
        Route::post('/simpan',                   [JurnalMakananController::class, 'simpan'])->name('pengguna.jurnalMakanan.simpan');
    });
    Route::get('/rekomendasi-jurnal-makanan', [JurnalMakananController::class, 'index']);
    Route::get('/jurnal-makanan',             [JurnalMakananController::class, 'index']);
    Route::get('/makanan/lainnya',            [JurnalMakananController::class, 'lainnya'])->name('pengguna.jurnalMakanan.lainnya');

    Route::get('/pola-tidur',          [PolaTidurController::class, 'index'])->name('pengguna.polaTidur');
    Route::post('/pola-tidur/simpan',  [PolaTidurController::class, 'simpan'])->name('pengguna.polaTidur.simpan');

    Route::get('/rekomendasi-aktivitas-fisik', [AktivitasFisikController::class, 'index'])->name('pengguna.aktivitasFisik');
    Route::get('/semua-aktivitas-fisik',       [AktivitasFisikController::class, 'aktivitas_all'])->name('aktivitas.all');
    Route::get('/aktivitas-fisik/{id}',        [AktivitasFisikController::class, 'detail'])->name('aktivitas.detail');

    Route::get('/konsultasi',                  [KonsultasiController::class, 'index'])->name('pengguna.konsultasi');
    Route::get('/konsultasi/{id}/chat',        [KonsultasiController::class, 'chat'])->name('pengguna.konsultasi.chat');
    Route::post('/konsultasi/{id}/pesan',      [KonsultasiController::class, 'kirimPesan'])->name('pengguna.konsultasi.kirimPesan');

    Route::get('/rekomendasi-artikel',  [ArtikelController::class, 'index'])->name('pengguna.artikel');
    Route::get('/artikel-edukasi',      [ArtikelController::class, 'index']);
    Route::get('/artikel/{id}',         [ArtikelController::class, 'detail'])->name('pengguna.artikel.detail');
    Route::get('/detail-artikel/{id}',  [ArtikelController::class, 'detail']);
    Route::get('/artikel-edukasi/all',  [ArtikelController::class, 'all'])->name('pengguna.artikel.all');

    Route::get('/profil',                  [ProfilController::class, 'show'])->name('pengguna.profil');
    Route::post('/profil/update',          [ProfilController::class, 'update'])->name('pengguna.profil.update');
    Route::post('/profil/ubah-password',   [ProfilController::class, 'ubahPassword'])->name('pengguna.profil.ubahPassword');
});

// ============ ADMIN ============
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',           [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/daftar-skrining',     [AdminController::class, 'daftarSkrining'])->name('skrining');
    Route::get('/daftar-target-diet',  [AdminController::class, 'daftarTargetDiet'])->name('targetDiet');
    Route::get('/daftar-pola-tidur',   [AdminController::class, 'daftarPolaTidur'])->name('polaTidur');

    Route::get('/kelola-jurnal-makanan',     [AdminController::class, 'kelolaJurnalMakanan'])->name('jurnalMakanan');
    Route::post('/makanan/simpan',           [AdminController::class, 'simpanMakanan'])->name('makanan.simpan');
    Route::post('/makanan/{id}/update',      [AdminController::class, 'updateMakanan'])->name('makanan.update');
    Route::post('/makanan/{id}/hapus',       [AdminController::class, 'hapusMakanan'])->name('makanan.hapus');

    Route::get('/kelola-aktivitas-fisik',    [AdminController::class, 'kelolaAktivitasFisik'])->name('aktivitasFisik');
    Route::post('/aktivitas/simpan',         [AdminController::class, 'simpanAktivitas'])->name('aktivitas.simpan');
    Route::post('/aktivitas/{id}/update',    [AdminController::class, 'updateAktivitas'])->name('aktivitas.update');
    Route::post('/aktivitas/{id}/hapus',     [AdminController::class, 'hapusAktivitas'])->name('aktivitas.hapus');

    Route::get('/kelola-pengguna',       [AdminController::class, 'kelolaPengguna'])->name('kelola_pengguna');
    Route::put('/pengguna/{id}',         [AdminController::class, 'updatePengguna'])->name('update_pengguna');
    Route::delete('/pengguna/{id}',      [AdminController::class, 'hapusPengguna'])->name('hapus_pengguna');
    Route::post('/kelola-pengguna',      [AdminController::class, 'store_pengguna'])->name('simpan_pengguna');

    Route::get('/kelola-ahli-gizi',      [AdminController::class, 'kelolaAhliGizi'])->name('kelola_ahli_gizi');
    Route::put('/ahli-gizi/{id}',        [AdminController::class, 'updateAhliGizi'])->name('update_ahli_gizi');
    Route::delete('/ahli-gizi/{id}',     [AdminController::class, 'hapusAhliGizi'])->name('hapus_ahli_gizi');
    Route::post('/kelola-ahli-gizi',     [AdminController::class, 'store_ahli_gizi'])->name('simpan_ahli_gizi');
});

// ============ AHLI GIZI ============
Route::middleware(['auth', 'role:ahli_gizi'])->prefix('ahli-gizi')->name('ahligizi.')->group(function () {
    Route::get('/dashboard',       [AhliGiziController::class, 'dashboard'])->name('dashboard');
    Route::post('/toggle-status',  [AhliGiziController::class, 'toggleStatus'])->name('toggleStatus');
    Route::get('/daftar-skrining', [AhliGiziController::class, 'daftarSkrining'])->name('skrining');
    Route::get('/daftar-target-diet', [AhliGiziController::class, 'daftarTargetDiet'])->name('targetDiet');

    Route::get('/jurnal-makanan',         [AhliGiziController::class, 'jurnalMakanan'])->name('jurnalMakanan');
    Route::post('/jurnal-makanan/simpan', [AhliGiziController::class, 'simpanJurnalMakanan'])->name('jurnalMakanan.simpan');
    Route::put('/jurnal-makanan/{id}', [AhliGiziController::class, 'updateJurnalMakanan'])->name('jurnalMakanan.update');
    Route::delete('/jurnal-makanan/{id}', [AhliGiziController::class, 'hapusJurnalMakanan'])->name('jurnalMakanan.hapus');

    Route::get('/konsultasi',              [KonsultasiController::class, 'indexAhliGizi'])->name('konsultasi');
    // Route::get('/konsultasi/{id}/chat',    [KonsultasiController::class, 'chatAhliGizi'])->name('konsultasi.chat');
    Route::get('/konsultasi/{id}/chat', function ($id) {
        return redirect()->route('ahligizi.konsultasi', ['chat' => $id]);
    })->name('konsultasi.chat');
    Route::post('/konsultasi/{id}/balas',  [KonsultasiController::class, 'balasPesan'])->name('konsultasi.balas');
    Route::post('/konsultasi/{id}/selesaikan', [KonsultasiController::class, 'selesaikan'])->name('konsultasi.selesaikan');
    Route::delete('/konsultasi/{id}/hapus',    [KonsultasiController::class, 'hapus'])->name('konsultasi.hapus');

    // Artikel CRUD
    Route::get('/artikel',               [ArtikelController::class, 'indexAhliGizi'])->name('artikel');
    Route::get('/artikel/tambah',        [ArtikelController::class, 'create'])->name('artikel.tambah');
    Route::post('/artikel/simpan',       [ArtikelController::class, 'store'])->name('artikel.simpan');
    Route::get('/artikel/{id}/edit',     [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::post('/artikel/{id}/update',  [ArtikelController::class, 'update'])->name('artikel.update');
    Route::post('/artikel/{id}/hapus',   [ArtikelController::class, 'destroy'])->name('artikel.hapus');
});
