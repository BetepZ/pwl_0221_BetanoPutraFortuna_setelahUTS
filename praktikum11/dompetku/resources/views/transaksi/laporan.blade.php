@extends('layout.master')
@section('title', 'Laporan Eksklusif')
@section('content')

<!-- Header Laporan -->
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Laporan Keuangan <span class="text-amber-500">VIP</span></h1>
        <p class="text-gray-500 text-sm mt-1">Analisis mendalam kondisi finansial Anda bulan ini.</p>
    </div>
    <div class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium shadow-lg shadow-indigo-200">
        Status: Member Premium
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Chart 1: Doughnut (Arus Kas) -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 relative overflow-hidden">
        <h3 class="text-lg font-semibold text-gray-700 mb-6">Proporsi Arus Kas</h3>
        <div class="relative h-64 w-full flex justify-center">
            <canvas id="cashflowChart"></canvas>
        </div>
        <div class="mt-4 text-center text-sm text-gray-500">
            *Data Live dari Database
        </div>
    </div>

    <!-- Chart 2: Bar (Dummy Mingguan - Soal tidak minta dinamis database) -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-700 mb-6">Tren Pengeluaran Mingguan</h3>
        <div class="relative h-64 w-full">
            <canvas id="weeklyChart"></canvas>
        </div>
    </div>
</div>

<!-- Insight Box -->
<div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-lg p-8 text-white mb-8">
    <div class="flex items-start space-x-4">
        <div class="bg-white/20 p-3 rounded-lg backdrop-blur-sm">
            <svg class="w-8 h-8 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
        </div>
        <div>
            <h3 class="text-xl font-bold mb-2">Insight Finansial AI</h3>
            <p class="text-indigo-100 leading-relaxed">
                Total Pemasukan: <span class="font-bold">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</span><br>
                Total Pengeluaran: <span class="font-bold">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // --- INTEGRASI DATA DINAMIS DARI CONTROLLER (Soal 4) ---
    const pemasukan = Number("{{ $totalPemasukan }}");
    const pengeluaran = Number("{{ $totalPengeluaran }}");
    const sisa = pemasukan - pengeluaran;

    // Chart 1: Doughnut
    const ctx1 = document.getElementById('cashflowChart').getContext('2d');
    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: ['Pemasukan', 'Pengeluaran', 'Sisa Saldo'],
            datasets: [{
                data: [pemasukan, pengeluaran, sisa], // Data dinamis disini
                backgroundColor: ['#10b981', '#f43f5e', '#3b82f6'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Chart 2: Bar (Tetap Dummy sesuai permintaan soal awal)
    const ctx2 = document.getElementById('weeklyChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            datasets: [{
                label: 'Pengeluaran (Rp)',
                data: [1200000, 900000, 850000, 1500000],
                backgroundColor: '#6366f1',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endsection