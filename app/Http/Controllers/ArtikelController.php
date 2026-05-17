<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Screening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ArtikelController extends Controller
{
    public function index()
    {
        $skriningTerakhir = Screening::where('user_id', Auth::id())->latest()->first();
        $statusImt = $skriningTerakhir ? $skriningTerakhir->status_imt : null;

        if ($statusImt) {
            $artikels = Article::where('rekomendasi_imt', $statusImt)
                ->orWhere('rekomendasi_imt', 'Semua')
                ->latest()
                ->get();
        } else {
            $artikels = Article::where('rekomendasi_imt', 'Semua')->latest()->get();
        }

        return view('pengguna.rekomendasi_artikel', compact('artikels', 'statusImt'));
    }

    public function all()
    {
        $artikels = Article::latest()->get();
        return view('pengguna.artikel_edukasi', compact('artikels'));
    }

    public function detail($id)
    {

        $artikel = Article::with('penulis')->findOrFail($id);

        $artikelTerkait = Article::where('rekomendasi_imt', $artikel->rekomendasi_imt)
            ->where('id', '!=', $id)
            ->latest()
            ->take(5)
            ->get();

        return view('pengguna.detail_artikel', compact('artikel', 'artikelTerkait'));
    }

    // ============ AHLI GIZI ============

    public function indexAhliGizi()
    {
        $artikels = Article::where('user_id', Auth::id())->latest()->get();
        return view('ahli_gizi.kelola_artikel', compact('artikels'));
    }

    public function create()
    {
        return view('ahli_gizi.tambah_artikel');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'rekomendasi_imt' => 'required|in:Underweight,Normal,Overweight,Obesitas 1,Obesitas 2,Semua',
            'gambar' => 'nullable|image|max:2048',
        ], [
            'judul.required' => 'Judul artikel wajib diisi.',
            'isi.required' => 'Isi artikel wajib diisi.',
            'rekomendasi_imt.required' => 'Rekomendasi IMT wajib dipilih.',
        ]);

        $gambarPath = null;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $gambarPath = time() . '_' . $file->getClientOriginalName();
            $tujuan = public_path('assets/images/artikel');

            if (!File::exists($tujuan)) {
                File::makeDirectory($tujuan, 0755, true);
            }

            $file->move($tujuan, $gambarPath);
        }

        Article::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $gambarPath,
            'rekomendasi_imt' => $request->rekomendasi_imt,
        ]);

        return redirect()->route('ahligizi.artikel')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $artikel = Article::where('user_id', Auth::id())->findOrFail($id);
        return view('ahli_gizi.edit_artikel', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        $artikel = Article::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'rekomendasi_imt' => 'required|in:Underweight,Normal,Overweight,Obesitas 1,Obesitas 2,Semua',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $gambarPath = $artikel->gambar;

        if ($request->hasFile('gambar')) {
            if ($gambarPath && file_exists(public_path('assets/images/artikel/' . $gambarPath))) {
                unlink(public_path('assets/images/artikel/' . $gambarPath));
            }

            $file = $request->file('gambar');
            $gambarPath = time() . '_' . $file->getClientOriginalName();
            $tujuan = public_path('assets/images/artikel');

            if (!File::exists($tujuan)) {
                File::makeDirectory($tujuan, 0755, true);
            }

            $file->move($tujuan, $gambarPath);
        }

        $artikel->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $gambarPath,
            'rekomendasi_imt' => $request->rekomendasi_imt,
        ]);

        return redirect()->route('ahligizi.artikel')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $artikel = Article::where('user_id', Auth::id())->findOrFail($id);
        if ($artikel->gambar) {
            $gambarPath = public_path('assets/images/artikel/' . $artikel->gambar);
            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }
        }
        $artikel->delete();
        return back()->with('success', 'Artikel berhasil dihapus.');
    }
}
