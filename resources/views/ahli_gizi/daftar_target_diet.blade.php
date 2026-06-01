@extends('layouts.layout_ahli_gizi')

@section('title', 'Target Diet Pasien')

    <link rel="stylesheet" href="{{ asset('assets/css/ahli_gizi/daftar_target_diet.css') }}">

    @section('content')
    <div class="target-page-wrapper">

        <div class="header-section">
            <div class="logo-circle">
                <svg viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.5">
                    <circle cx="12" cy="12" r="10" />
                    <circle cx="12" cy="12" r="6" />
                    <circle cx="12" cy="12" r="2" />
                </svg>
            </div>
            <h1>Target Diet</h1>
        </div>

        <div class="main-blue-container">

            <div class="search-wrapper">
                <div class="search-input-group">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input type="text" id="liveSearch" placeholder="Cari Pengguna..." autocomplete="off">
                </div>
            </div>

            <div class="target-grid" id="cards-container">
                @include('ahli_gizi.partials._target_diet_cards', ['targets' => $targets])
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#liveSearch').on('keyup', function() {
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('ahligizi.targetDiet') }}",
                    type: "GET",
                    data: {
                        search: query
                    },
                    success: function(data) {
                        $('#cards-container').html(data);
                    }
                });
            });
        });
    </script>

@endsection
