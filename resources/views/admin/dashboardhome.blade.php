@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-3xl fw-bold">Dashboard Admin</h1>

    {{-- Style tambahan untuk grafik --}}
    <style>
        canvas {
            max-height: 300px !important;
            width: 100% !important;
        }
    </style>

    {{-- Filter Bulan & Tahun --}}
    <form method="GET" action="{{ route('admin.dashboardhome') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label class="form-label">Bulan</label>
            <select name="month" class="form-select">
                @foreach(range(1,12) as $m)
                    <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Tahun</label>
            <select name="year" class="form-select">
                @for($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn text-white" style="background-color: #00218D;">Filter</button>
        </div>
        <div class="col-md-2 d-flex align-items-end">
        <a href="{{ route('admin.export.pdf', ['month' => $month, 'year' => $year]) }}" target="_blank" class="btn btn-danger w-100">
            <i class="bi bi-file-earmark-pdf-fill me-1"></i> Export PDF
        </a>
</div>

    </form>

    {{-- Statistik Tamu --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Total Tamu</h5>
                    <p class="card-text h4 text-primary">{{ $totalTamu }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Tamu Bulan Ini</h5>
                    <p class="card-text h4 text-primary">{{ $tamuBulanIni }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-secondary">Tamu Hari Ini</h5>
                    <p class="card-text h4 text-primary">{{ $tamuHariIni }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Bidang Paling Banyak Dikunjungi --}}
    <div class="mb-4">
        <h5 class="fw-bold text-secondary">Bidang Paling Banyak Dikunjungi</h5>
        <div class="card shadow-sm">
            <div class="card-body">
                <p class="fs-5 text-primary fw-semibold mb-0">{{ $mostVisitedBidang }}</p>
            </div>
        </div>
    </div>

    {{-- Grafik Kunjungan per Hari --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title text-secondary">Kunjungan per Hari - {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}</h5>
            <canvas id="lineChart"></canvas>
        </div>
    </div>

    {{-- Grafik Kunjungan per Bidang --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title text-secondary">Distribusi Kunjungan per Bidang</h5>
            <canvas id="barChart"></canvas>
        </div>
    </div>

    {{-- Grafik Pie Jawaban Survei --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="card-title text-secondary">Distribusi Jawaban Survei (Keseluruhan)</h5>
            @if(empty($surveyData))
                <p class="mb-0 text-secondary">Belum ada data jawaban survei.</p>
            @else
                <canvas id="pieChart"></canvas>
            @endif
        </div>
    </div>

    {{-- Grafik Survei per Pertanyaan --}}
    @if(count($surveyChartData) === 0)
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <p class="mb-0 text-secondary">Belum ada data survei per pertanyaan.</p>
            </div>
        </div>
    @else
        @foreach($surveyChartData as $data)
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title text-secondary">{{ $data['question'] }}</h5>
                    <canvas id="surveyChart{{ $loop->index }}"></canvas>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const lineCtx = document.getElementById('lineChart');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: @json($labelsMonth),
            datasets: [{
                label: 'Jumlah Tamu',
                data: @json($dataMonth),
                borderColor: '#00218D',
                backgroundColor: 'rgba(0,33,141,0.1)',
                fill: true,
                tension: 0.3
            }]
        }
    });

    const barCtx = document.getElementById('barChart');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: @json($labelsBidang),
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: @json($dataBidang),
                backgroundColor: '#00218D'
            }]
        }
    });

    @if(!empty($surveyData))
    const pieCtx = document.getElementById('pieChart');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: @json($surveyLabels),
            datasets: [{
                data: @json($surveyData),
                backgroundColor: ['#00218D', '#FF914D', '#10B981', '#F59E0B', '#EF4444']
            }]
        }
    });
    @endif

    @foreach($surveyChartData as $index => $data)
        new Chart(document.getElementById('surveyChart{{ $loop->index }}'), {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($data['answers'])) !!},
                datasets: [{
                    label: 'Jumlah Jawaban',
                    data: {!! json_encode(array_values($data['answers'])) !!},
                    backgroundColor: '#00218D'
                }]
            }
        });
    @endforeach
</script>
@endsection
