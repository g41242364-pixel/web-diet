@extends('layouts.layout_admin')
@section('title', 'Skrining Admin')

<link rel="stylesheet" href="{{ asset('assets/css/admin/daftar_skrining.css') }}">

@section('content')

<div class="skrining-header">
    <h2>Skrining IMT</h2>
    <p>Data hasil skrining indeks massa tubuh seluruh pengguna.</p>
</div>

<div class="table-container">

    <div class="table-top">
        <span>Total: {{ $screenings->total() }} data skrining</span>
    </div>

    <div class="table-responsive">
        <table class="skrining-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>BB (kg)</th>
                    <th>TB (cm)</th>
                    <th>IMT</th>
                    <th>Status IMT</th>
                    <th>Status Kebiasaan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>

            <tbody>
                @forelse($screenings as $i => $s)
                <tr>
                    <td>{{ $screenings->firstItem() + $i }}</td>
                    <td>{{ $s->user->name }}</td>
                    <td>{{ $s->berat_badan }}</td>
                    <td>{{ $s->tinggi_badan }}</td>
                    <td>{{ $s->imt }}</td>

                    <td>
                        <span class="status-pill
                            @if($s->status_imt == 'Normal')
                                status-ideal
                            @elseif(in_array($s->status_imt,['Obesitas','Obesitas I','Obesitas II']))
                                status-obesitas
                            @elseif(in_array($s->status_imt,['Kurus','Sangat Kurus']))
                                status-underweight
                            @else
                                status-overweight
                            @endif">
                            {{ $s->status_imt }}
                        </span>
                    </td>

                    <td>{{ $s->status_kebiasaan }}</td>
                    <td>{{ $s->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="empty-data">
                        Belum ada data skrining.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        {{ $screenings->links() }}
    </div>

</div>

@endsection