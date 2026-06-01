@extends('layouts.layout_ahli_gizi')

@section('title', 'Jurnal Makanan - Ahli Gizi')

@section('content')

    <style>
        .jurnal-page-container {
            max-width: 1000px;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .page-header {
            margin-bottom: 30px;
        }

        .page-header h2 {
            font-size: 32px;
            font-weight: 800;
            color: #000;
        }

        .page-header p {
            color: #666;
            font-size: 16px;
        }

        .alert {
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 14px;
        }

        .alert-success {
            background: #e8f8e8;
            color: #27ae60;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #fde8e8;
            color: #c0392b;
            border: 1px solid #f5c6cb;
        }

        .form-card,
        .history-section {
            background: #fff;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1.5px solid #e8f0f5;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #333;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #444;
        }

        .label-hint {
            font-weight: 400;
            color: #888;
            font-size: 12px;
        }

        .form-select {
            width: 100%;
            padding: 12px;
            border: 1.5px solid #ddd;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.3s;
        }

        .form-select:focus {
            border-color: #90D2ED;
        }

        .summary-box {
            display: none;
            background: #e8f4fd;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 15px;
            display: flex;
            gap: 25px;
            border-left: 5px solid #90D2ED;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .summary-box.visible {
            display: flex !important;
            opacity: 1;
            transform: translateY(0);
        }

        .summary-item {
            font-size: 14px;
            font-weight: 700;
            color: #2980b9;
        }

        .summary-item small {
            font-weight: 400;
            color: #5d97bc;
        }

        .food-selection-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 12px;
            max-height: 350px;
            overflow-y: auto;
            border: 1.5px solid #eee;
            border-radius: 15px;
            padding: 15px;
            background: #fdfdfd;
        }

        .food-checkbox-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border: 1.5px solid #eee;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            background: #fff;
            user-select: none;
        }

        .food-checkbox-card:hover {
            background: #f0faff;
            border-color: #90D2ED;
        }

        .food-checkbox-card.checked {
            background: #f0faff;
            border-color: #90D2ED;
        }

        .food-check,
        .food-check-edit {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #90D2ED;
        }

        .food-name {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .food-stats {
            font-size: 11px;
            color: #888;
        }

        .btn-submit {
        background: #2563EB;
        color: #FFFFFF;
        border: none;
        border-radius: 999px;
        padding: 12px 28px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        transition: .2s;
        }

        .btn-submit:hover {
        background: #1D4ED8;
        transform: translateY(-2px);
        }

        .history-item {
            border: 1.5px solid #f0f4f8;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 15px;
            transition: background 0.3s;
        }

        .history-item:hover {
            background: #fafcfd;
        }

        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .history-meta {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .category-badge {
            font-weight: 700;
            font-size: 14px;
            color: #2c3e50;
        }

        .imt-badge {
            font-size: 11px;
            padding: 3px 10px;
            background: #e8f4fd;
            border-radius: 20px;
            color: #2980b9;
            font-weight: 600;
        }

        .history-date {
            font-size: 12px;
            color: #999;
        }

        .history-nutrition {
            display: flex;
            gap: 15px;
            margin-bottom: 12px;
        }

        .nutri-tag {
            font-size: 13px;
            font-weight: 600;
            color: #555;
            background: #f8f9fa;
            padding: 4px 10px;
            border-radius: 8px;
        }

        .history-foods {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .food-tag {
            font-size: 11px;
            padding: 4px 12px;
            background: #f0f8ff;
            border-radius: 20px;
            color: #2980b9;
            font-weight: 500;
            border: 1px solid #d0e8f8;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #aaa;
        }

        .pagination-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .food-selection-grid::-webkit-scrollbar {
            width: 6px;
        }

        .food-selection-grid::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .food-selection-grid::-webkit-scrollbar-thumb {
            background: #90D2ED;
            border-radius: 10px;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            backdrop-filter: blur(4px);
        }

        .modal-box {
            background: #b0cddb;
            width: 90%;
            max-width: 650px;
            border-radius: 12px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            box-sizing: border-box;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-box h3 {
            text-align: center;
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            margin: 0 0 25px 0;
            letter-spacing: 0.5px;
        }

        .modal-row-custom {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
            gap: 20px;
        }

        .modal-label-custom {
            flex: 1;
            font-size: 16px;
            font-weight: 700;
            color: #444444;
            text-align: left;
        }

        .modal-input-wrapper-custom {
            flex: 2;
        }

        .modal-input-custom {
            width: 100%;
            padding: 10px 15px;
            border: 1.5px solid #d4e3eb;
            background-color: #dbe7ed;
            color: #555555;
            font-size: 15px;
            font-weight: 600;
            border-radius: 6px;
            outline: none;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }

        .modal-input-custom:focus {
            border-color: #7BB9D8;
        }

        .modal-footer {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-modal {
            padding: 10px 35px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-batal {
            background: #ffffff;
            color: #555555;
        }

        .btn-batal:hover {
            background: #f5f8fa;
        }

        .btn-simpan {
            background: #27ae60;
            color: #ffffff;
        }

        .btn-simpan:hover {
            background: #219653;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .summary-box {
                flex-direction: column;
                gap: 5px;
            }

            .modal-row-custom {
                flex-direction: column;
                align-items: stretch;
                gap: 5px;
            }
        }
    </style>

    <div class="jurnal-page-container">

        <div class="page-header">
            <h2>Jurnal Makanan</h2>
            <p>Buat rekomendasi jurnal makanan berdasarkan status IMT pasien.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <div class="form-card">
            <h4 class="card-title">📝 Buat Rekomendasi Jurnal Makanan</h4>
            <form action="{{ route('ahligizi.jurnalMakanan.simpan') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label>Status IMT</label>
                        <select name="status_imt" class="form-select" required>
                            <option value="">-- Pilih Status IMT --</option>
                            @foreach ($statusImtOptions as $opt)
                                <option value="{{ $opt }}">{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kategori Makan</label>
                        <select name="kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kat)
                                <option value="{{ $kat }}">{{ ucfirst(str_replace('_', ' ', $kat)) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Pilih Makanan <span class="label-hint">(bisa lebih dari satu)</span></label>

                    <div id="nutrisiSummary" class="summary-box">
                        <div class="summary-item">Total: <span id="sumKalori">0</span> <small>kcal</small></div>
                        <div class="summary-item">Protein: <span id="sumProtein">0</span><small>g</small></div>
                        <div class="summary-item">Karbo: <span id="sumKarbo">0</span><small>g</small></div>
                        <div class="summary-item">Lemak: <span id="sumLemak">0</span><small>g</small></div>
                    </div>

                    <div class="food-selection-grid">
                        @foreach ($foods as $food)
                            <label class="food-checkbox-card" data-kalori="{{ $food->kalori }}"
                                data-protein="{{ $food->protein }}" data-karbo="{{ $food->karbohidrat }}"
                                data-lemak="{{ $food->lemak }}">
                                <input type="checkbox" name="food_ids[]" value="{{ $food->id }}" class="food-check">
                                <div class="food-info">
                                    <div class="food-name">{{ $food->nama }}</div>
                                    <div class="food-stats">{{ $food->kalori }} kcal · P:{{ $food->protein }}g
                                        K:{{ $food->karbohidrat }}g L:{{ $food->lemak }}g</div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">Simpan Jurnal</button>
                </div>
            </form>
        </div>

        <div class="history-section">
            <h4 class="card-title">📋 Riwayat Jurnal Saya</h4>
            <div class="history-list">
                @forelse($mealPlans as $plan)
                    <div class="history-item">
                        <div class="history-header">
                            <div class="history-meta">
                                <span class="category-badge">{{ ucfirst(str_replace('_', ' ', $plan->kategori)) }}</span>
                                <span class="imt-badge">{{ $plan->status_imt }}</span>
                            </div>

                            <div class="history-actions-wrapper" style="display: flex; align-items: center; gap: 8px;">
                                <span class="history-date"
                                    style="margin-right: 10px;">{{ \Carbon\Carbon::parse($plan->tanggal)->format('d M Y') }}</span>

                                <button
                                    onclick="document.getElementById('editJurnalModal{{ $plan->id }}').style.display='flex'"
                                    style="padding: 6px 14px; background: #f39c12; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 700; transition: transform 0.2s;">
                                    Edit
                                </button>

                                <form action="{{ route('ahligizi.jurnalMakanan.hapus', $plan->id) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus rekomendasi jurnal makanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="padding: 6px 14px; background: #e74c3c; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-size: 12px; font-weight: 700; transition: transform 0.2s;">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="history-nutrition">
                            <div class="nutri-tag">🔥 {{ $plan->total_kalori }} <small>kcal</small></div>
                            <div class="nutri-tag">💪 P: {{ $plan->total_protein }}g</div>
                            <div class="nutri-tag">🌾 K: {{ $plan->total_karbohidrat }}g</div>
                            <div class="nutri-tag">🧈 L: {{ $plan->total_lemak }}g</div>
                        </div>

                        <div class="history-foods">
                            @foreach ($plan->items as $item)
                                <span class="food-tag">{{ $item->food->nama }}</span>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <p>Belum ada jurnal makanan yang dibuat.</p>
                    </div>
                @endforelse
            </div>

            <div class="pagination-wrapper">
                {{ $mealPlans->links() }}
            </div>
        </div>
    </div>

    @foreach ($mealPlans as $plan)
        <div id="editJurnalModal{{ $plan->id }}" class="modal-overlay"
            onclick="if(event.target == this) this.style.display='none'">
            <div class="modal-box">
                <h3>Edit Rekomendasi Jurnal</h3>
                <form action="{{ route('ahligizi.jurnalMakanan.update', $plan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-row-custom">
                        <div class="modal-label-custom">Status IMT</div>
                        <div class="modal-input-wrapper-custom">
                            <select name="status_imt" class="modal-input-custom" required>
                                @foreach ($statusImtOptions as $opt)
                                    <option value="{{ $opt }}" {{ $plan->status_imt == $opt ? 'selected' : '' }}>
                                        {{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-row-custom">
                        <div class="modal-label-custom">Kategori Makan</div>
                        <div class="modal-input-wrapper-custom">
                            <select name="kategori" class="modal-input-custom" required>
                                @foreach ($kategoris as $kat)
                                    <option value="{{ $kat }}" {{ $plan->kategori == $kat ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_', ' ', $kat)) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-row-custom" style="flex-direction: column; align-items: stretch; gap: 8px;">
                        <div class="modal-label-custom" style="margin-bottom: 5px;">Pilih Makanan <span
                                class="label-hint">(bisa lebih dari satu)</span></div>
                        <div class="food-selection-grid" style="max-height: 220px; background: #ffffff;">
                            @php

                                $selectedFoodIds = $plan->items->pluck('food_id')->toArray();
                            @endphp
                            @foreach ($foods as $food)
                                @php
                                    $isChecked = in_array($food->id, $selectedFoodIds);
                                @endphp
                                <label class="food-checkbox-card {{ $isChecked ? 'checked' : '' }}">
                                    <input type="checkbox" name="food_ids[]" value="{{ $food->id }}"
                                        class="food-check-edit" {{ $isChecked ? 'checked' : '' }}
                                        onchange="this.closest('.food-checkbox-card').classList.toggle('checked', this.checked)">
                                    <div class="food-info">
                                        <div class="food-name" style="color: #333;">{{ $food->nama }}</div>
                                        <div class="food-stats" style="color: #777;">{{ $food->kalori }} kcal ·
                                            P:{{ $food->protein }}g K:{{ $food->karbohidrat }}g L:{{ $food->lemak }}g
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn-modal btn-simpan">Simpan Perubahan</button>
                        <button type="button" class="btn-modal btn-batal"
                            onclick="document.getElementById('editJurnalModal{{ $plan->id }}').style.display='none'">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    <script>
        document.querySelectorAll('.food-check').forEach(cb => {
            cb.addEventListener('change', function() {
                const card = this.closest('.food-checkbox-card');
                card.classList.toggle('checked', this.checked);
                updateNutrisi();
            });
        });

        function updateNutrisi() {
            let kalori = 0,
                protein = 0,
                karbo = 0,
                lemak = 0;
            let checkedCount = 0;

            document.querySelectorAll('.food-check:checked').forEach(cb => {
                const card = cb.closest('.food-checkbox-card');
                kalori += parseFloat(card.dataset.kalori || 0);
                protein += parseFloat(card.dataset.protein || 0);
                karbo += parseFloat(card.dataset.karbo || 0);
                lemak += parseFloat(card.dataset.lemak || 0);
                checkedCount++;
            });

            const summary = document.getElementById('nutrisiSummary');
            if (checkedCount > 0) {
                summary.classList.add('visible');
            } else {
                summary.classList.remove('visible');
            }

            document.getElementById('sumKalori').textContent = kalori.toFixed(1);
            document.getElementById('sumProtein').textContent = protein.toFixed(1);
            document.getElementById('sumKarbo').textContent = karbo.toFixed(1);
            document.getElementById('sumLemak').textContent = lemak.toFixed(1);
        }
    </script>
@endsection
