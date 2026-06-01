@extends('layouts.layout_ahli_gizi')

@section('title', 'Jurnal Makanan - Ahli Gizi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/jurnal_makanan.css') }}">
@endpush

@section('content')

    <div class="page-title-section">
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
                                style="margin-right: 6px;">{{ \Carbon\Carbon::parse($plan->tanggal)->format('d M Y') }}</span>

                            <button class="btn-edit-history"
                                onclick="document.getElementById('editJurnalModal{{ $plan->id }}').style.display='flex'">
                                Edit
                            </button>

                            <form action="{{ route('ahligizi.jurnalMakanan.hapus', $plan->id) }}" method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus rekomendasi jurnal makanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus-history">Hapus</button>
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

    {{-- Edit Modals --}}
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
                        <div class="modal-label-custom">Pilih Makanan <span class="label-hint">(bisa lebih dari satu)</span></div>
                        <div class="food-selection-grid" style="max-height: 220px;">
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
                                        <div class="food-name">{{ $food->nama }}</div>
                                        <div class="food-stats">{{ $food->kalori }} kcal ·
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
            let kalori = 0, protein = 0, karbo = 0, lemak = 0;
            let checkedCount = 0;

            document.querySelectorAll('.food-check:checked').forEach(cb => {
                const card = cb.closest('.food-checkbox-card');
                kalori  += parseFloat(card.dataset.kalori  || 0);
                protein += parseFloat(card.dataset.protein || 0);
                karbo   += parseFloat(card.dataset.karbo   || 0);
                lemak   += parseFloat(card.dataset.lemak   || 0);
                checkedCount++;
            });

            const summary = document.getElementById('nutrisiSummary');
            summary.classList.toggle('visible', checkedCount > 0);

            document.getElementById('sumKalori').textContent  = kalori.toFixed(1);
            document.getElementById('sumProtein').textContent = protein.toFixed(1);
            document.getElementById('sumKarbo').textContent   = karbo.toFixed(1);
            document.getElementById('sumLemak').textContent   = lemak.toFixed(1);
        }
    </script>

@endsection