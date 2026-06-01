@extends('layouts.layout_admin')

@section('title', 'Admin - Kelola Aktivitas Fisik')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/admin/kelola_aktivitas_fisik.css') }}">

    <div class="activity-admin-container">

        <div class="activity-admin-header">
            <h2>Aktivitas Fisik</h2>
            <p>Kelola dan pantau seluruh aktivitas fisik yang tersedia.</p>
        </div>

        @if (session('success'))
            <div style="background:#e8f8e8;color:#27ae60;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="add-activity-form-container">
            <h4>Tambah Aktivitas Baru</h4>
            <form action="{{ route('admin.aktivitas.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid-3">
                    <div class="form-group">
                        <label>Nama Aktivitas</label>
                        <input type="text" name="nama" placeholder="Lari Pagi" required class="form-control-input">
                    </div>
                    <div class="form-group">
                        <label>Durasi</label>
                        <input type="text" name="durasi" placeholder="30 menit" required class="form-control-input">
                    </div>
                    <div class="form-group">
                        <label>Status Kebiasaan</label>
                        <select name="status_kebiasaan" required class="form-control-input">
                            <option value="">-- Pilih --</option>
                            <option value="Hidup Sehat">Hidup Sehat</option>
                            <option value="Cukup Sehat">Cukup Sehat</option>
                            <option value="Kurang Sehat">Kurang Sehat</option>
                            <option value="Tidak Sehat">Tidak Sehat</option>
                        </select>
                    </div>
                </div>

                <div class="form-grid-3">
                    <div class="form-group">
                        <label>Kategori Intensitas</label>
                        <select name="intensitas" required class="form-control-input">
                            <option value="">-- Pilih --</option>
                            <option value="Ringan">Ringan</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Berat">Berat</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori Lokasi</label>
                        <select name="lokasi" required class="form-control-input">
                            <option value="">-- Pilih --</option>
                            <option value="Dalam Ruangan">Dalam Ruangan</option>
                            <option value="Luar Ruangan">Luar Ruangan</option>
                            <option value="Fleksibel">Fleksibel</option>
                        </select>
                    </div>
                    <<div class="form-group">
                        <label>Link YouTube</label>
                        <input type="url" name="link_youtube" placeholder="https://www.youtube.com/watch?v=..." class="form-control-input">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" rows="2" placeholder="Deskripsi aktivitas..." class="form-control-input"
                        style="resize:none;"></textarea>
                </div>

                <button type="submit"
                    style="padding:10px 24px;background:#90D2ED;color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:700;cursor:pointer;box-shadow: 0 4px 10px rgba(144, 210, 237, 0.35);">
                    + Tambah Aktivitas
                </button>
            </form>
        </div>

        <div class="search-info-bar">
            <div class="activity-count">Total Aktivitas: {{ $aktivitas->total() }} item</div>
        </div>

        <div class="table-wrapper">
            <table class="activity-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Aktivitas</th>
                        <th>Deskripsi</th>
                        <th>Status Kebiasaan</th>
                        <th style="text-align:center; width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aktivitas as $i => $act)
                        <tr>
                            <td>{{ $aktivitas->firstItem() + $i }}</td>
                            <td style="font-weight: 700;">{{ $act->nama }}</td>
                            <td>{{ Str::limit($act->deskripsi, 60) }}</td>
                            <td>
                                <span
                                    style="font-size:12px;padding:4px 12px;background:#e8f4fd;border-radius:12px;color:#2980b9;font-weight:700;">
                                    {{ $act->status_kebiasaan }}
                                </span>
                            </td>
                            <td style="text-align:center;">
                                <button
                                    onclick="document.getElementById('editModal{{ $act->id }}').style.display='flex'"
                                    style="padding:6px 14px;background:#f39c12;color:#fff;border:none;border-radius:8px;cursor:pointer;font-size:13px;font-weight:700;margin-right:4px;">
                                    Edit
                                </button>

                                <form action="{{ route('admin.aktivitas.hapus', $act->id) }}" method="POST"
                                    style="display:inline;" onsubmit="return confirm('Hapus aktivitas ini?')">
                                    @csrf
                                    <button type="submit"
                                        style="padding:6px 14px;background:#e74c3c;color:#fff;border:none;border-radius:8px;cursor:pointer;font-size:13px;font-weight:700;">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;color:#aaa;padding:40px;font-weight:600;">
                                Belum ada data aktivitas fisik.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $aktivitas->links() }}
        </div>

    </div>

    @foreach ($aktivitas as $act)
        <div id="editModal{{ $act->id }}" class="modal-overlay-custom"
            onclick="if(event.target == this) this.style.display='none'">
            <div class="modal-content-custom">
                <h3 class="modal-title-custom">Detail & Edit Aktivitas</h3>

                <form action="{{ route('admin.aktivitas.update', $act->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="modal-row-custom">
                        <div class="modal-label-custom">Nama Aktivitas</div>
                        <div class="modal-input-wrapper-custom">
                            <input type="text" name="nama" value="{{ $act->nama }}" required
                                class="modal-input-custom">
                        </div>
                    </div>

                    <div class="modal-row-custom">
                        <div class="modal-label-custom">Durasi</div>
                        <div class="modal-input-wrapper-custom">
                            <input type="text" name="durasi" value="{{ $act->durasi }}" required
                                class="modal-input-custom">
                        </div>
                    </div>

                    <div class="modal-row-custom">
                        <div class="modal-label-custom">Status Kebiasaan</div>
                        <div class="modal-input-wrapper-custom">
                            <select name="status_kebiasaan" required class="modal-input-custom">
                                <option value="Hidup Sehat" {{ $act->status_kebiasaan == 'Hidup Sehat' ? 'selected' : '' }}>Hidup Sehat
                                </option>
                                <option value="Cukup Sehat" {{ $act->status_kebiasaan == 'Cukup Sehat' ? 'selected' : '' }}>Cukup Sehat
                                </option>
                                <option value="Kurang Sehat" {{ $act->status_kebiasaan == 'Kurang Sehat' ? 'selected' : '' }}>Kurang Sehat
                                </option>
                                <option value="Tidak Sehat" {{ $act->status_kebiasaan == 'Tidak Sehat' ? 'selected' : '' }}>Tidak Sehat
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-row-custom">
                        <div class="modal-label-custom">Intensitas</div>
                        <div class="modal-input-wrapper-custom">
                            <select name="intensitas" required class="modal-input-custom">
                                <option value="Ringan" {{ $act->intensitas == 'Ringan' ? 'selected' : '' }}>Ringan
                                </option>
                                <option value="Sedang" {{ $act->intensitas == 'Sedang' ? 'selected' : '' }}>Sedang
                                </option>
                                <option value="Berat" {{ $act->intensitas == 'Berat' ? 'selected' : '' }}>Berat</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-row-custom">
                        <div class="modal-label-custom">Kategori Lokasi</div>
                        <div class="modal-input-wrapper-custom">
                            <select name="lokasi" required class="modal-input-custom">
                                <option value="Dalam Ruangan" {{ $act->lokasi == 'Dalam Ruangan' ? 'selected' : '' }}>
                                    Dalam Ruangan</option>
                                <option value="Luar Ruangan" {{ $act->lokasi == 'Luar Ruangan' ? 'selected' : '' }}>Luar
                                    Ruangan</option>
                                <option value="Fleksibel" {{ $act->lokasi == 'Fleksibel' ? 'selected' : '' }}>Fleksibel
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-row-custom">
                        <div class="modal-label-custom">Link YouTube</div>
                        <div class="modal-input-wrapper-custom">
                            <input type="url" name="link_youtube" value="{{ $act->link_youtube }}" 
                            placeholder="https://www.youtube.com/watch?v=..." class="modal-input-custom">
                        </div>
                    </div>

                    <div class="modal-row-custom">
                        <div class="modal-label-custom">Deskripsi</div>
                        <div class="modal-input-wrapper-custom">
                            <textarea name="deskripsi" rows="2" class="modal-input-custom modal-textarea-custom" required>{{ $act->deskripsi }}</textarea>
                        </div>
                    </div>

                    <div class="modal-footer-custom">
                        <button type="submit" class="btn-modal-action-save">Simpan</button>
                        <button type="button"
                            onclick="document.getElementById('editModal{{ $act->id }}').style.display='none'"
                            class="btn-modal-action-close">Tutup</button>
                    </div>

                </form>
            </div>
        </div>
    @endforeach

@endsection
