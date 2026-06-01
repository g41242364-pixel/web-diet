@extends('layouts.layout_admin')
@section('title', 'Admin - Kelola Aktivitas Fisik')

<link rel="stylesheet" href="{{ asset('assets/css/admin/kelola_aktivitas_fisik.css') }}">

@section('content')

<div class="food-page-header">
    <h2>Kelola Aktivitas Fisik</h2>
    <p>Kelola dan pantau seluruh aktivitas fisik yang tersedia pada sistem.</p>
</div>

@if(session('success'))
<div class="success-alert">
    ✓ {{ session('success') }}
</div>
@endif

<div class="form-card">

    <div class="card-title">
        Tambah Aktivitas Baru
    </div>

    <form action="{{ route('admin.aktivitas.simpan') }}" method="POST">
        @csrf

        <div class="form-grid">

            <div class="form-group">
                <label>Nama Aktivitas</label>
                <input
                    type="text"
                    name="nama"
                    placeholder="Lari Pagi"
                    required>
            </div>

            <div class="form-group">
                <label>Durasi</label>
                <input
                    type="text"
                    name="durasi"
                    placeholder="30 menit"
                    required>
            </div>

            <div class="form-group">
                <label>Status Kebiasaan</label>
                <select name="status_kebiasaan" required>
                    <option value="">-- Pilih --</option>
                    <option value="Baik">Baik</option>
                    <option value="Kurang">Kurang</option>
                </select>
            </div>

            <div class="form-group">
                <label>Kategori Intensitas</label>
                <select name="kategori_intensitas" required>
                    <option value="">-- Pilih --</option>
                    <option value="Ringan">Ringan</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Berat">Berat</option>
                </select>
            </div>

            <div class="form-group">
                <label>Kategori Lokasi</label>
                <select name="kategori_lokasi" required>
                    <option value="">-- Pilih --</option>
                    <option value="Indoor">Indoor</option>
                    <option value="Outdoor">Outdoor</option>
                </select>
            </div>

            <div class="form-group">
                <label>Link YouTube</label>
                <input
                    type="text"
                    name="youtube_link"
                    placeholder="https://www.youtube.com/watch?v=...">
            </div>

            <div class="form-group" style="grid-column:1/-1;">
                <label>Deskripsi</label>
                <textarea
                    name="deskripsi"
                    rows="4"
                    placeholder="Deskripsi aktivitas..."></textarea>
            </div>

        </div>

        <button type="submit" class="btn-primary">
            + Tambah Aktivitas
        </button>

    </form>

</div>

<div class="info-card">
    Total Aktivitas: {{ $activities->total() }} item
</div>

<div class="table-card">

    <div class="table-responsive">

        <table class="activity-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Aktivitas</th>
                    <th>Durasi</th>
                    <th>Intensitas</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($activities as $i => $activity)

                <tr>

                    <td>{{ $activities->firstItem() + $i }}</td>
                    <td>{{ $activity->nama }}</td>
                    <td>{{ $activity->durasi }}</td>
                    <td>{{ $activity->kategori_intensitas }}</td>
                    <td>{{ $activity->kategori_lokasi }}</td>
                    <td>{{ $activity->status_kebiasaan }}</td>

                    <td style="text-align:center;">

                        <button
                            class="btn-edit"
                            onclick="document.getElementById('editActivity{{ $activity->id }}').style.display='table-row'">
                            Edit
                        </button>

                        <form
                            action="{{ route('admin.aktivitas.hapus', $activity->id) }}"
                            method="POST"
                            style="display:inline;"
                            onsubmit="return confirm('Hapus aktivitas ini?')">

                            @csrf

                            <button type="submit" class="btn-delete">
                                Hapus
                            </button>

                        </form>

                    </td>

                </tr>

                <tr
                    id="editActivity{{ $activity->id }}"
                    class="edit-row"
                    style="display:none;">

                    <td colspan="7">

                        <form
                            action="{{ route('admin.aktivitas.update', $activity->id) }}"
                            method="POST">

                            @csrf

                            <div class="edit-grid">

                                <div class="form-group">
                                    <label>Nama Aktivitas</label>
                                    <input
                                        type="text"
                                        name="nama"
                                        value="{{ $activity->nama }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Durasi</label>
                                    <input
                                        type="text"
                                        name="durasi"
                                        value="{{ $activity->durasi }}"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Intensitas</label>
                                    <input
                                        type="text"
                                        name="kategori_intensitas"
                                        value="{{ $activity->kategori_intensitas }}"
                                        required>
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
                                    onclick="document.getElementById('editActivity{{ $activity->id }}').style.display='none'">
                                    Batal
                                </button>

                            </div>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="empty-data">
                        Belum ada data aktivitas.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="pagination-wrapper">
    {{ $activities->links() }}
</div>

@endsection