@extends('layouts.layout_ahli_gizi')
@section('title', 'Tambah Artikel')

@section('content')
<div style="max-width:760px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
        <a href="{{ route('ahligizi.artikel') }}" style="color:#888;text-decoration:none;font-size:13px;">← Kembali</a>
        <h2 style="font-size:24px;font-weight:800;">Tambah Artikel Baru</h2>
    </div>

    @if($errors->any())
        <div style="background:#fde8e8;color:#c0392b;padding:12px 16px;border-radius:8px;margin-bottom:16px;">{{ $errors->first() }}</div>
    @endif

    <div style="background:#fff;border-radius:12px;padding:24px;border:1.5px solid #e8f0f5;">
        <form action="{{ route('ahligizi.artikel.simpan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;">Judul Artikel</label>
                <input type="text" name="judul" value="{{ old('judul') }}" placeholder="Tuliskan judul artikel..." required
                    style="width:100%;padding:11px 14px;border:1.5px solid #ddd;border-radius:8px;font-size:14px;">
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:16px;">
                <div>
                    <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;">Rekomendasi IMT</label>
                    <select name="rekomendasi_imt" required style="width:100%;padding:11px 14px;border:1.5px solid #ddd;border-radius:8px;font-size:14px;">
                        <option value="">-- Pilih --</option>
                        <option value="Underweight" {{ old('rekomendasi_imt')=='Underweight'?'selected':'' }}>Underweight (&lt; 18,5)</option>
                        <option value="Normal" {{ old('rekomendasi_imt')=='Normal'?'selected':'' }}>Normal (18,5 - 22,9)</option>
                        <option value="Overweight" {{ old('rekomendasi_imt')=='Overweight'?'selected':'' }}>Overweight (23 - 24,9)</option>
                        <option value="Obesitas 1" {{ old('rekomendasi_imt')=='Obesitas 1'?'selected':'' }}>Obesitas 1 (25 - 29,9)</option>
                        <option value="Obesitas 2" {{ old('rekomendasi_imt')=='Obesitas 2'?'selected':'' }}>Obesitas 2 (&gt; 30)</option>
                        <option value="Semua" {{ old('rekomendasi_imt')=='Semua'?'selected':'' }}>Semua</option>
                    </select>
                </div>

                <div>
                    <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;">Gambar (opsional)</label>
                    <input type="file" name="gambar" accept="image/*" style="width:100%;padding:9px;border:1.5px solid #ddd;border-radius:8px;font-size:13px;">
                </div>
            </div>

            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;">Isi Artikel</label>
                <textarea name="isi" rows="12" placeholder="Tuliskan isi artikel..." required
                    style="width:100%;padding:11px 14px;border:1.5px solid #ddd;border-radius:8px;font-size:14px;line-height:1.6;resize:vertical;">{{ old('isi') }}</textarea>
            </div>

            <div style="display:flex;gap:10px;">
                <button type="submit"
                style="
                padding:12px 28px;
                background:#2563EB;
                color:#FFFFFF;
                border:none;
                border-radius:999px;
                font-size:15px;
                font-weight:700;
                cursor:pointer;
                transition:.2s;">
                Simpan Artikel
                </button>
                <a href="{{ route('ahligizi.artikel') }}" style="padding:11px 20px;background:#f0f0f0;color:#555;border-radius:8px;text-decoration:none;font-size:14px;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
