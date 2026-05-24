@extends('layouts.layout_pengguna')
@section('title', 'Pola Tidur')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/pola_tidur.css') }}">

@section('content')
<div class="sleep-container">

    <!-- HEADER -->
    <div class="sleep-header">
        <img src="{{ asset('assets/images/bulan.png') }}"
             alt="Logo Bulan"
             onerror="this.src='https://cdn-icons-png.flaticon.com/512/1808/1808605.png'">

        <div>
            <h2>Pola Tidur</h2>
            <p>Analisis kualitas dan durasi tidur anda</p>
        </div>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div style="background:#e8f8e8;color:#27ae60;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background:#fde8e8;color:#c0392b;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- FORM -->
    <div class="card-white">
        <form action="{{ route('pengguna.polaTidur.simpan') }}" method="POST">
            @csrf

            <div class="input-group">
                <label>Jam Tidur</label>
                <input type="time" name="jam_tidur" value="22:30" required>
            </div>

            <div class="input-group">
                <label>Jam Bangun</label>
                <input type="time" name="jam_bangun" value="06:30" required>
            </div>

            <div class="input-group">
                <label>Catatan (Opsional)</label>
                <input type="text"
                       name="catatan"
                       placeholder="Tidur nyenyak, tidak mimpi buruk...">
            </div>

            <button type="submit" class="btn-calculate">
                Simpan Pola Tidur
            </button>
        </form>
    </div>

    <!-- CONTENT -->
    <div class="content-area">

        @if($sleepLogs->count() > 0)

            @php
                $latest = $sleepLogs->first();
            @endphp

            <!-- HASIL -->
            <div class="result-view">

                <h3>Hasil Pola Tidur Terbaru</h3>

                <table class="result-table">

                    <tr>
                        <td>Jam Tidur</td>
                        <td>:</td>
                        <td>{{ $latest->jam_tidur }}</td>
                    </tr>

                    <tr>
                        <td>Jam Bangun</td>
                        <td>:</td>
                        <td>{{ $latest->jam_bangun }}</td>
                    </tr>

                    <tr>
                        <td>Durasi Tidur</td>
                        <td>:</td>
                        <td>
                            <span class="text-purple">
                                {{ $latest->durasi_jam }} jam
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td>Status Tidur</td>
                        <td>:</td>

                        <td>
                            <span class="status-pill 
                            {{ strtolower($latest->status_tidur) }}">

                                {{ $latest->status_tidur == 'Baik'
                                    ? 'Cukup'
                                    : $latest->status_tidur }}

                            </span>
                        </td>

                    </tr>

                    <tr>
                        <td>Catatan</td>
                        <td>:</td>
                        <td>{{ $latest->catatan ?? '-' }}</td>
                    </tr>

                </table>

                <!-- REKOMENDASI -->
                <div class="recommendation-box">

                    <h4>Rekomendasi</h4>

                    <p>

                        @if($latest->status_tidur == 'Kurang')

                            Durasi tidur Anda kurang dari 6 jam.
                            Usahakan untuk beristirahat lebih awal
                            agar tubuh tetap bugar.

                        @elseif($latest->status_tidur == 'Berlebih')

                            Tidur terlalu lama juga tidak baik
                            bagi kesehatan. Cobalah untuk bangun
                            lebih awal dan beraktivitas.

                        @else

                            Pola tidur Anda sudah baik!
                            Pertahankan kebiasaan tidur yang sehat
                            untuk hidup yang lebih berkualitas.

                        @endif

                    </p>

                </div>

            </div>

            <!-- RIWAYAT -->
            <div style="margin-top:25px;">

                <h4 style="font-size:16px;font-weight:700;margin-bottom:15px;">
                    Riwayat 7 Hari Terakhir
                </h4>

                <table class="history-table">

                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Tidur</th>
                            <th>Bangun</th>
                            <th>Durasi</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($sleepLogs as $log)

                        <tr>

                            <td>
                                {{ \Carbon\Carbon::parse($log->tanggal)->format('d M') }}
                            </td>

                            <td>
                                {{ $log->jam_tidur }}
                            </td>

                            <td>
                                {{ $log->jam_bangun }}
                            </td>

                            <td>
                                {{ $log->durasi_jam }} jam
                            </td>

                            <td>

                                <span class="status-badge 
                                {{ strtolower($log->status_tidur) }}">

                                    {{ $log->status_tidur == 'Baik'
                                        ? 'Cukup'
                                        : $log->status_tidur }}

                                </span>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <!-- TAMPILAN AWAL -->
            <div class="initial-view">

                <ul class="tips-list">
                    <li>Usahakan tidur 7-9 jam setiap malam</li>
                    <li>Tidur dan bangun di jam yang sama setiap hari</li>
                    <li>Hindari gadget sebelum tidur</li>
                    <li>Ciptakan suasana kamar yang nyaman</li>
                </ul>

                <img src="{{ asset('assets/images/tidur.png') }}"
                     alt="Gambar Orang Tidur"
                     onerror="this.src='https://img.freepik.com/free-vector/hand-drawn-person-sleeping-illustration_23-2149842426.jpg'">

            </div>

        @endif

    </div>
</div>
@endsection