@extends('layouts.layout_ahli_gizi')
@section('title', 'Edit Artikel')

@section('content')
<div style="max-width:760px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
        <a href="{{ route('ahligizi.artikel') }}" style="color:#888;text-decoration:none;font-size:13px;">← Kembali</a>
        <h2 style="font-size:24px;font-weight:800;">Edit Artikel</h2>
    </div>

    @if($errors->any())
        <div style="background:#fde8e8;color:#c0392b;padding:12px 16px;border-radius:8px;margin-bottom:16px;">{{ $errors->first() }}</div>
    @endif

    <div style="background:#fff;border-radius:12px;padding:24px;border:1.5px solid #e8f0f5;">
        <form action="{{ route('ahligizi.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;">Judul Artikel</label>
                <input type="text" name="judul" value="{{ old('judul', $artikel->judul) }}" required
                    style="width:100%;padding:11px 14px;border:1.5px solid #ddd;border-radius:8px;font-size:14px;">
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:16px;">
                <div>
                    <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;">Rekomendasi IMT</label>
                    <select name="rekomendasi_imt" required style="width:100%;padding:11px 14px;border:1.5px solid #ddd;border-radius:8px;font-size:14px;">
                        @foreach(['Underweight','Normal','Overweight','Obesitas 1','Obesitas 2','Semua'] as $opt)
                        <option value="{{ $opt }}" {{ $artikel->rekomendasi_imt==$opt?'selected':'' }}>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;">Ganti Gambar (opsional)</label>
                    @if($artikel->gambar)
                        <img src="{{ asset('storage/'.$artikel->gambar) }}" style="width:60px;height:50px;object-fit:cover;border-radius:6px;margin-bottom:6px;display:block;">
                    @endif
                    <input type="file" name="gambar" accept="image/*" style="width:100%;padding:9px;border:1.5px solid #ddd;border-radius:8px;font-size:13px;">
                </div>
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:13px;font-weight:600;margin-bottom:6px;">Isi Artikel</label>
                <textarea name="isi" rows="12" required
                    style="width:100%;padding:11px 14px;border:1.5px solid #ddd;border-radius:8px;font-size:14px;line-height:1.6;resize:vertical;">{{ old('isi', $artikel->isi) }}</textarea>
            </div>
            <div style="display:flex;gap:10px;">
                <button type="submit" style="padding:11px 28px;background:#90D2ED;color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:600;cursor:pointer;">Update Artikel</button>
                <a href="{{ route('ahligizi.artikel') }}" style="padding:11px 20px;background:#f0f0f0;color:#555;border-radius:8px;text-decoration:none;font-size:14px;">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
