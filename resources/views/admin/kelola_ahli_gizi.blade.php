@extends('layouts.layout_admin')

@section('title', 'Kelola Ahli Gizi')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/admin/kelola_ahli_gizi.css') }}">

    <div class="manage-account-container">

        <div class="header-area">
            <div class="header-title-row">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="8.5" cy="7" r="4" />
                </svg>
                <div class="header-text">
                    <h2>Kelola Akun Ahli Gizi</h2>
                    <p>Manajemen data akun seluruh ahli gizi aplikasi</p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div
                style="background:#e8f8e8;color:#27ae60;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-weight:600;">
                ✓ {{ session('success') }}
            </div>
        @endif

        <div class="add-account-form-container">
            <h4>Tambah Ahli Gizi Baru</h4>
            <form action="{{ route('admin.simpan_ahli_gizi') }}" method="POST">
                @csrf
                <div class="form-grid-3">
                    <div class="form-group-add">
                        <label>Nama Ahli Gizi</label>
                        <input type="text" name="name" placeholder="Nama Lengkap" required class="form-control-input">
                    </div>
                    <div class="form-group-add">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="contoh@email.com" required
                            class="form-control-input">
                    </div>
                    <div class="form-group-add">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="••••••••" required class="form-control-input">
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group-add">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" required class="form-control-input">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group-add">
                        <label>Umur (Tahun)</label>
                        <input type="number" name="umur" min="1" placeholder="30" required
                            class="form-control-input">
                    </div>
                </div>

                <button type="submit" class="btn-submit-add">
                    + Tambah Ahli Gizi
                </button>
            </form>
        </div>

        <div class="content-box">

            <form method="GET" action="{{ route('admin.kelola_ahli_gizi') }}">
                <div class="search-wrapper">
                    <div class="search-input-container">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5">
                            <circle cx="11" cy="11" r="8" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" />
                        </svg>
                        <input type="text" name="search" placeholder="Cari nama ahli gizi"
                            value="{{ request('search') }}">
                    </div>
                </div>
            </form>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Ahli Gizi</th>
                        <th>Email</th>
                        <th>Status Akun</th>
                        <th>Tanggal Daftar</th>
                        <th style="text-align: center; width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td>
                                {{ $users->firstItem() + $index }}
                            </td>
                            <td>
                                <div class="user-info-cell">
                                    <div class="avatar-icon">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#000">
                                            <path
                                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                        </svg>
                                    </div>
                                    <div class="user-meta">
                                        <span>{{ $user->name }}</span>
                                        <small>
                                            {{ $user->jenis_kelamin ?? '-' }}
                                            •
                                            {{ $user->umur ? $user->umur . ' tahun' : '-' }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="status-badge">
                                    {{ $user->is_online ? 'Online' : 'Offline' }}
                                </span>
                            </td>
                            <td>
                                {{ $user->created_at->translatedFormat('d F Y') }}
                            </td>
                            <td style="text-align: center;">

                                <button class="action-btn"
                                    onclick="showEditModal(
                                    '{{ $user->id }}',
                                    '{{ $user->name }}',
                                    '{{ $user->email }}',
                                    '{{ $user->jenis_kelamin }}',
                                    '{{ $user->umur }}',
                                    '{{ $user->is_online ? 'Online' : 'Offline' }}'
                                )">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </button>

                                <form action="{{ route('admin.hapus_ahli_gizi', $user->id) }}" method="POST"
                                    style="display:inline-block"
                                    onsubmit="return confirm('Yakin ingin menghapus ahli gizi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <polyline points="3 6 5 6 21 6" />
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; color:#aaa; padding: 40px; font-weight:600;">
                                Data ahli gizi tidak ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="pagination-row">
                <span>
                    Menampilkan
                    {{ $users->firstItem() ?? 0 }}
                    -
                    {{ $users->lastItem() ?? 0 }}
                    dari
                    {{ $users->total() }}
                    data
                </span>
                <div class="pagination-links">
                    {{ $users->links() }}
                </div>
            </div>

        </div>

    </div>

    <div id="modalEdit" class="modal-overlay">
        <div class="modal-box">
            <h3>Edit Akun Ahli Gizi</h3>
            <form id="formEditUser" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-row-custom">
                    <div class="modal-label-custom">Nama Ahli Gizi</div>
                    <div class="modal-input-wrapper-custom">
                        <input type="text" name="name" id="editName" required class="modal-input-custom">
                    </div>
                </div>

                <div class="modal-row-custom">
                    <div class="modal-label-custom">Email</div>
                    <div class="modal-input-wrapper-custom">
                        <input type="email" name="email" id="editEmail" required class="modal-input-custom">
                    </div>
                </div>

                <div class="modal-row-custom">
                    <div class="modal-label-custom">Jenis Kelamin</div>
                    <div class="modal-input-wrapper-custom">
                        <select name="jenis_kelamin" id="editGender" required class="modal-input-custom">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="modal-row-custom">
                    <div class="modal-label-custom">Umur</div>
                    <div class="modal-input-wrapper-custom">
                        <input type="number" name="umur" id="editUmur" min="1" required
                            class="modal-input-custom">
                    </div>
                </div>

                <div class="modal-row-custom">
                    <div class="modal-label-custom">Status Akun</div>
                    <div class="modal-input-wrapper-custom">
                        <input type="text" id="editStatus" readonly class="modal-input-custom" style="opacity: 0.7;">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn-modal btn-simpan">Simpan Perubahan</button>
                    <button type="button" class="btn-modal btn-batal" onclick="hideModal()">Batal</button>
                </div>

                <p class="modal-subtext">
                    Perubahan data akan diperbarui pada sistem.
                </p>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function showEditModal(id, name, email, gender, umur, status) {
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editGender').value = gender;
            document.getElementById('editUmur').value = umur;
            document.getElementById('editStatus').value = status;

            document.getElementById('formEditUser').action = `/admin/ahli-gizi/${id}`;
            document.getElementById('modalEdit').style.display = 'flex';
        }

        function hideModal() {
            document.getElementById('modalEdit').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('modalEdit')) {
                hideModal();
            }
        }
    </script>
@endpush
