@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
@endpush

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl sm:text-4xl font-bold text-primary">Dashboard</h1>
        <a href="{{ route('admin.publikasi.berita.create') }}" class="btn btn-primary gap-2">
            <i class="fa-solid fa-plus"></i>
            <span class="hidden sm:inline">Buat Postingan</span>
        </a>
    </div>

    {{-- Content Stats --}}
    <section aria-labelledby="content-stats-heading">
        <h2 id="content-stats-heading" class="text-lg font-semibold mb-4 text-base-content/80">
            Statistik Konten
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            {{-- Total Postingan --}}
            <div class="card border border-base-300 shadow-sm bg-base-100">
                <div class="card-body p-5">
                    <p class="text-sm text-base-content/60 font-medium">Total Postingan</p>
                    <div class="flex items-center gap-3 mt-1">
                        <i class="fa-solid fa-newspaper text-primary text-xl"></i>
                        <span class="text-4xl font-bold text-base-content">{{ $totalPosts ?? 0 }}</span>
                    </div>
                </div>
            </div>

            {{-- Jumlah Dokumen --}}
            <div class="card border border-base-300 shadow-sm bg-base-100">
                <div class="card-body p-5">
                    <p class="text-sm text-base-content/60 font-medium">Jumlah Dokumen</p>
                    <div class="flex items-center gap-3 mt-1">
                        <i class="fa-solid fa-book text-primary text-xl"></i>
                        <span class="text-4xl font-bold text-base-content">{{ $totalDocuments ?? 0 }}</span>
                    </div>
                </div>
            </div>

            {{-- Total Admin --}}
            <div class="card border border-base-300 shadow-sm bg-base-100">
                <div class="card-body p-5">
                    <p class="text-sm text-base-content/60 font-medium">Total Admin</p>
                    <div class="flex items-center gap-3 mt-1">
                        <i class="fa-solid fa-user text-primary text-xl"></i>
                        <span class="text-4xl font-bold text-base-content">{{ $totalAdmins ?? 0 }}</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Visitor Chart --}}
    <section class="mt-8" aria-labelledby="chart-heading">
        <h2 id="chart-heading" class="text-lg font-semibold mb-4 text-base-content/80">
            Grafik Kunjungan (30 Hari Terakhir)
        </h2>
        <div class="card border border-base-300 shadow-sm bg-base-100">
            <div class="card-body p-5">
                <canvas id="visitorChart" height="100" aria-label="Grafik kunjungan unik 30 hari terakhir"></canvas>
            </div>
        </div>
    </section>

    {{-- Visitor Stats --}}
    <section class="mt-8" aria-labelledby="visitor-stats-heading">
        <h2 id="visitor-stats-heading" class="text-lg font-semibold mb-4 text-base-content/80">
            Statistik Kunjungan
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            {{-- Hari Ini --}}
            <div class="card border border-base-300 shadow-sm bg-base-100">
                <div class="card-body p-5">
                    <p class="text-sm text-base-content/60 font-medium">Kunjungan Hari Ini</p>
                    <p class="text-4xl font-bold text-primary mt-1">
                        {{ $visitorStats['today']['total'] ?? 0 }}
                    </p>
                    <p class="text-xs text-base-content/50 flex items-center gap-3 mt-2">
                        <span><i class="fa-solid fa-mobile-screen mr-1"></i>{{ $visitorStats['today']['mobile'] ?? 0 }}</span>
                        <span><i class="fa-solid fa-desktop mr-1"></i>{{ $visitorStats['today']['desktop'] ?? 0 }}</span>
                    </p>
                </div>
            </div>

            {{-- Bulan Ini --}}
            <div class="card border border-base-300 shadow-sm bg-base-100">
                <div class="card-body p-5">
                    <p class="text-sm text-base-content/60 font-medium">Kunjungan Bulan Ini</p>
                    <p class="text-4xl font-bold text-primary mt-1">
                        {{ $visitorStats['thisMonth']['total'] ?? 0 }}
                    </p>
                    <p class="text-xs text-base-content/50 flex items-center gap-3 mt-2">
                        <span><i class="fa-solid fa-mobile-screen mr-1"></i>{{ $visitorStats['thisMonth']['mobile'] ?? 0 }}</span>
                        <span><i class="fa-solid fa-desktop mr-1"></i>{{ $visitorStats['thisMonth']['desktop'] ?? 0 }}</span>
                    </p>
                </div>
            </div>

            {{-- Tahun Ini --}}
            <div class="card border border-base-300 shadow-sm bg-base-100">
                <div class="card-body p-5">
                    <p class="text-sm text-base-content/60 font-medium">Kunjungan Tahun Ini</p>
                    <p class="text-4xl font-bold text-primary mt-1">
                        {{ $visitorStats['thisYear']['total'] ?? 0 }}
                    </p>
                    <p class="text-xs text-base-content/50 flex items-center gap-3 mt-2">
                        <span><i class="fa-solid fa-mobile-screen mr-1"></i>{{ $visitorStats['thisYear']['mobile'] ?? 0 }}</span>
                        <span><i class="fa-solid fa-desktop mr-1"></i>{{ $visitorStats['thisYear']['desktop'] ?? 0 }}</span>
                    </p>
                </div>
            </div>

            {{-- Total Homepage --}}
            <div class="card border border-base-300 shadow-sm bg-base-100">
                <div class="card-body p-5">
                    <p class="text-sm text-base-content/60 font-medium">Total Kunjungan Homepage</p>
                    <p class="text-4xl font-bold text-primary mt-1">
                        {{ $visitorStats['homepage']['total'] ?? 0 }}
                    </p>
                    <p class="text-xs text-base-content/50 flex items-center gap-3 mt-2">
                        <span><i class="fa-solid fa-mobile-screen mr-1"></i>{{ $visitorStats['homepage']['mobile'] ?? 0 }}</span>
                        <span><i class="fa-solid fa-desktop mr-1"></i>{{ $visitorStats['homepage']['desktop'] ?? 0 }}</span>
                    </p>
                </div>
            </div>

        </div>
    </section>
    <div class="mt-8 text-xs text-end">
        &copy; {{ date('Y') }} BGTK Provinsi NTT
    </div>

</div>
@endsection

@push('scripts')
<script>
    (function () {
        const chartData = @json($chartData ?? []);
        const labels = chartData.map(d => d.date);
        const values = chartData.map(d => d.total);

        const isDark = document.documentElement.getAttribute('data-theme') === 'mytheme-dark';
        const gridColor = isDark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.06)';
        const labelColor = isDark ? '#94a3b8' : '#64748b';

        const ctx = document.getElementById('visitorChart');
        if (!ctx) return;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Pengunjung Unik',
                    data: values,
                    borderColor: 'oklch(0.5675 0.1305 247.94)',
                    backgroundColor: 'oklch(0.5675 0.1305 247.94 / 0.15)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                }]
            },
            options: {
                responsive: true,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: { display: false },
                    tooltip: { mode: 'index' }
                },
                scales: {
                    x: {
                        grid: { color: gridColor },
                        ticks: { color: labelColor, maxTicksLimit: 10 }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: gridColor },
                        ticks: { color: labelColor, precision: 0 }
                    }
                }
            }
        });
    })();
</script>
@endpush
