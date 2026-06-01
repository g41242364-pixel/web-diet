@extends('layouts.layout_ahli_gizi')

@section('title', 'Target Diet Pasien')

<link rel="stylesheet" href="{{ asset('assets/css/ahli_gizi/daftar_target_diet.css') }}">

@section('content')

<div class="page-title-section">
    <h2>Target Diet Pasien</h2>
    <p>Pantau perkembangan target diet seluruh pasien</p>
</div>

<div class="search-card">
    <div class="search-input-group">

        <svg width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>

        <input
            type="text"
            id="liveSearch"
            placeholder="Cari nama pasien..."
            autocomplete="off">

    </div>
</div>

<div class="table-top">
    Total: {{ $targets->count() }} data target diet
</div>

<div class="target-grid" id="cards-container">
    @include('ahli_gizi.partials._target_diet_cards', ['targets' => $targets])
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    $('#liveSearch').on('keyup', function(){

        let query = $(this).val();

        $.ajax({
            url: "{{ route('ahligizi.targetDiet') }}",
            type: "GET",
            data: {
                search: query
            },
            success: function(response){
                $('#cards-container').html(response);
            }
        });

    });

});
</script>
@endpush