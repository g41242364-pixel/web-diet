@extends('layouts.layout_admin')
@section('title', 'Admin - Kelola Makanan')

<link rel="stylesheet" href="{{ asset('assets/css/admin/kelola_jurnal_makanan.css') }}">

@section('content')

<div class="food-page-header">
    <h2>Kelola Makanan</h2>
    <p>Kelola dan pantau seluruh daftar makanan serta kandungan nutrisinya.</p>
</div>

@if(session('success'))
<div class="success-alert">
    ✓ {{ session('success') }}
</div>
@endif

<div class="form-card">

    <div class="card-title">
        Tambah Makanan Baru
    </div>

    <form action="{{ route('admin.makanan.simpan') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>Nama</label>
                <input
                    type="text"
                    name="nama"
                    placeholder="Nasi Putih"
                    required>
            </div>

            <div class="form-group">
                <label>Kalori (kcal)</label>
                <input
                    type="number"
                    name="kalori"
                    step="0.01"
                    placeholder="175"
                    required>
            </div>

            <div class="form-group">
                <label>Protein (g)</label>
                <input
                    type="number"
                    name="protein"
                    step="0.01"
                    placeholder="4"
                    required>
            </div>

            <div class="form-group">
                <label>Karbohidrat (g)</label>
                <input
                    type="number"
                    name="karbohidrat"
                    step="0.01"
                    placeholder="38"
                    required>
            </div>

            <div class="form-group">
                <label>Lemak (g)</label>
                <input
                    type="number"
                    name="lemak"
                    step="0.01"
                    placeholder="0.5"
                    required>
            </div>

            <div class="form-group">
                <label>Gambar</label>
                <input
                    type="file"
                    name="gambar"
                    accept="image/*">
            </div>

        </div>

        <button type="submit"
                style="
                background:#2563EB;
                color:#FFFFFF;
                border:none;
                border-radius:999px;
                padding:12px 28px;
                font-size:15px;
                font-weight:700;
                cursor:pointer;">
                + Tambah Makanan
        </button>

    </form>

</div>

<div class="info-card">
    Total Makanan: {{ $foods->total() }} item
</div>

<div class="table-card">

    <div class="table-responsive">

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

                        <button
                            class="btn-edit"
                            onclick="document.getElementById('editFood{{ $food->id }}').style.display='table-row'">
                            Edit
                        </button>

                        <form
                            action="{{ route('admin.makanan.hapus', $food->id) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Hapus makanan ini?')">

                            @csrf

                            <button type="submit" class="btn-delete">
                                Hapus
                            </button>

                        </form>

                    </td>
                </tr>

                <tr
                    id="editFood{{ $food->id }}"
                    class="edit-row"
                    style="display:none;">

                    <td colspan="7">

                        <form
                            action="{{ route('admin.makanan.update', $food->id) }}"
                            method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            <div class="edit-grid">

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input
                                        type="text"
                                        name="nama"
                                        value="{{ $food->nama }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Kalori</label>
                                    <input
                                        type="number"
                                        name="kalori"
                                        step="0.01"
                                        value="{{ $food->kalori }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Protein</label>
                                    <input
                                        type="number"
                                        name="protein"
                                        step="0.01"
                                        value="{{ $food->protein }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Karbohidrat</label>
                                    <input
                                        type="number"
                                        name="karbohidrat"
                                        step="0.01"
                                        value="{{ $food->karbohidrat }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Lemak</label>
                                    <input
                                        type="number"
                                        name="lemak"
                                        step="0.01"
                                        value="{{ $food->lemak }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Gambar Baru</label>
                                    <input
                                        type="file"
                                        name="gambar"
                                        accept="image/*">
                                </div>

                            </div>

                            <div style="margin-top:15px;display:flex;gap:10px;">

                                <button
                                    type="submit"
                                    class="btn-save">
                                    Simpan
                                </button>

                                <button
                                    type="button"
                                    class="btn-cancel"
                                    onclick="document.getElementById('editFood{{ $food->id }}').style.display='none'">
                                    Batal
                                </button>

                            </div>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="empty-data">
                        Belum ada data makanan.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="pagination-wrapper">
    {{ $foods->links() }}
</div>

@endsection