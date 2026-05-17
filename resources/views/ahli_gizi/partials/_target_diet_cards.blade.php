@forelse($targets as $target)
    @php
        $checkinTerbaru = $target->checkins->first();

        $progress = 0;
        if ($target->berat_awal && $checkinTerbaru) {
            $diff = abs($target->berat_awal - $target->berat_target);
            $actual = abs($target->berat_awal - $checkinTerbaru->berat_sekarang);
            $progress = $diff > 0 ? min(100, round(($actual / $diff) * 100)) : 0;
        }

        $bmi = 22.8;
        $status = 'Ideal';
    @endphp

    <div class="diet-card">
        <div class="card-header">
            <h4>{{ $target->user->name }}</h4>
            <span class="bmi-info">BMI {{ $bmi }} · {{ $status }}</span>
        </div>

        <div class="card-inner">
            <div class="inner-header">
                <span class="badge-tujuan">
                    {{ $target->tujuan == 'menambah' ? 'Menambah BB' : 'Menurunkan BB' }}
                </span>
            </div>

            <div class="diet-details">
                <p>Target {{ abs($target->berat_awal - $target->berat_target) }} kg</p>
                <p>Mulai {{ $target->created_at->format('d M Y') }}</p>
            </div>

            <div class="progress-section">
                <span>Progres {{ $progress }}%</span>
                <div class="progress-rail">
                    <div class="progress-fill" style="width: {{ $progress }}%"></div>
                </div>
            </div>
        </div>
    </div>

@empty
    <div class="empty-state">
        Data tidak ditemukan
    </div>
@endforelse
