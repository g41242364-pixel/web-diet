@extends('layouts.layout_admin')
@section('title', 'Admin - Kelola Makanan')
<link rel="stylesheet" href="{{ asset('assets/css/admin/kelola_jurnal_makanan.css') }}">

@section('content')
    <div class="activity-admin-container">
        <div class="activity-admin-header">
            <h2>Kelola Makanan</h2>
            <p>Kelola dan pantau seluruh daftar makanan serta kandungan nutrisinya.</p>
        </div>

        @if(session('success'))<div style="background:#e8f8e8;color:#27ae60;padding:12px 16px;border-radius:8px;margin-bottom:16px;">✓ {{ session('success') }}</div>@endif

        <div style="background:#fff;border-radius:12px;padding:20px;margin-bottom:20px;border:1.5px solid #e8f0f5;">
            <h4 style="font-weight:600;margin-bottom:14px;">Tambah Makanan Baru</h4>
            <form action="{{ route('admin.makanan.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:10px;margin-bottom:12px;">
                    <div><label style="font-size:12px;font-weight:500;">Nama</label><input type="text" name="nama" placeholder="Nasi Putih" required style="width:100%;padding:8px;border:1.5px solid #ddd;border-radius:6px;font-size:13px;"></div>
                    <div><label style="font-size:12px;font-weight:500;">Kalori (kcal)</label><input type="number" name="kalori" step="0.01" placeholder="175" required style="width:100%;padding:8px;border:1.5px solid #ddd;border-radius:6px;font-size:13px;"></div>
                    <div><label style="font-size:12px;font-weight:500;">Protein (g)</label><input type="number" name="protein" step="0.01" placeholder="4" required style="width:100%;padding:8px;border:1.5px solid #ddd;border-radius:6px;font-size:13px;"></div>
                    <div><label style="font-size:12px;font-weight:500;">Karbohidrat (g)</label><input type="number" name="karbohidrat" step="0.01" placeholder="38" required style="width:100%;padding:8px;border:1.5px solid #ddd;border-radius:6px;font-size:13px;"></div>
                    <div><label style="font-size:12px;font-weight:500;">Lemak (g)</label><input type="number" name="lemak" step="0.01" placeholder="0.5" required style="width:100%;padding:8px;border:1.5px solid #ddd;border-radius:6px;font-size:13px;"></div>
                    <div><label style="font-size:12px;font-weight:500;">Gambar</label><input type="file" name="gambar" accept="image/*" style="width:100%;padding:6px;border:1.5px solid #ddd;border-radius:6px;font-size:12px;"></div>
                </div>
                <button type="submit" style="padding:8px 20px;background:#90D2ED;color:#fff;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;">+ Tambah</button>
            </form>
        </div>

        <div class="search-info-bar">
            <div class="activity-count">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
                <span>Total Makanan: {{ $foods->total() }} item</span>
            </div>
        </div>

        <div class="table-wrapper">
            <table class="activity-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Makanan</th>
                        <th>Kalori</th>
                        <th>Protein</th>
                        <th>Karbohidrat</th>
                        <th>Lemak</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($foods as $i => $food)
                    <tr>
                        <td>{{ $foods->firstItem() + $i }}</td>
                        <td>{{ $food->nama }}</td>
                        <td>{{ $food->kalori }} kcal</td>
                        <td>{{ $food->protein }} g</td>
                        <td>{{ $food->karbohidrat }} g</td>
                        <td>{{ $food->lemak }} g</td>
                        <td style="text-align:center;">
                            <button onclick="document.getElementById('editFood{{ $food->id }}').style.display='block'" style="padding:5px 10px;background:#f39c12;color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:12px;margin-right:4px;">Edit</button>
                            <form action="{{ route('admin.makanan.hapus', $food->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus makanan ini?')">
                                @csrf
                                <button type="submit" style="padding:5px 10px;background:#e74c3c;color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:12px;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <tr id="editFood{{ $food->id }}" style="display:none;background:#f0f8ff;">
                        <td colspan="7" style="padding:12px;">
                            <form action="{{ route('admin.makanan.update', $food->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:8px;">
                                    <div><label style="font-size:11px;">Nama</label><input type="text" name="nama" value="{{ $food->nama }}" required style="width:100%;padding:6px;border:1.5px solid #ddd;border-radius:6px;font-size:12px;"></div>
                                    <div><label style="font-size:11px;">Kalori</label><input type="number" name="kalori" step="0.01" value="{{ $food->kalori }}" required style="width:100%;padding:6px;border:1.5px solid #ddd;border-radius:6px;font-size:12px;"></div>
                                    <div><label style="font-size:11px;">Protein</label><input type="number" name="protein" step="0.01" value="{{ $food->protein }}" required style="width:100%;padding:6px;border:1.5px solid #ddd;border-radius:6px;font-size:12px;"></div>
                                    <div><label style="font-size:11px;">Karbohidrat</label><input type="number" name="karbohidrat" step="0.01" value="{{ $food->karbohidrat }}" required style="width:100%;padding:6px;border:1.5px solid #ddd;border-radius:6px;font-size:12px;"></div>
                                    <div><label style="font-size:11px;">Lemak</label><input type="number" name="lemak" step="0.01" value="{{ $food->lemak }}" required style="width:100%;padding:6px;border:1.5px solid #ddd;border-radius:6px;font-size:12px;"></div>
                                    <div><label style="font-size:11px;">Gambar Baru</label><input type="file" name="gambar" accept="image/*" style="width:100%;padding:4px;border:1.5px solid #ddd;border-radius:6px;font-size:11px;"></div>
                                </div>
                                <div style="margin-top:8px;display:flex;gap:8px;">
                                    <button type="submit" style="padding:6px 14px;background:#27ae60;color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:12px;">Simpan</button>
                                    <button type="button" onclick="document.getElementById('editFood{{ $food->id }}').style.display='none'" style="padding:6px 14px;background:#95a5a6;color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:12px;">Batal</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" style="text-align:center;color:#aaa;padding:24px;">Belum ada data makanan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="margin-top:16px;">{{ $foods->links() }}</div>
    </div>
@endsection
