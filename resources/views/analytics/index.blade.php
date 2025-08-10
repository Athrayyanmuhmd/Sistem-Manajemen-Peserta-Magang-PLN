@extends('layouts.pln-dashboard')

@section('title', 'Analytics Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        
        <!-- Header Section -->
        <div class="bg-blue-600 rounded-lg shadow-lg mb-6">
            <div class="px-6 py-4">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 bg-blue-700 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <span class="text-blue-100 text-sm font-medium">Analytics Dashboard</span>
                        </div>
                        <h1 class="text-2xl font-bold text-white mb-1">Analytics & Strategic Insights</h1>
                        <p class="text-blue-100 text-sm">Laporan mendalam dan analisis strategis untuk pengambilan keputusan</p>
                    </div>
                    <div class="flex items-center space-x-3 mt-4 lg:mt-0">
                        <button onclick="refreshDashboard()" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-600 bg-white rounded-md hover:bg-gray-50 shadow-sm transition-all duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Refresh
                        </button>
                        <a href="{{ route('analytics.export') }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-blue-800 rounded-md hover:bg-blue-900 shadow-sm transition-all duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overview Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Total Peserta -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">+12%</span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Peserta</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($analytics['overview']['total_interns_current']) }}</p>
                </div>
            </div>

            <!-- Peserta Aktif -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Aktif</span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Sedang Aktif</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($analytics['overview']['active_now']) }}</p>
                </div>
            </div>

            <!-- Universitas Partner -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                        </svg>
                    </div>
                    <span class="text-xs text-gray-500">Partner</span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Universitas</p>
                    <p class="text-2xl font-bold text-gray-900">12</p>
                </div>
            </div>

            <!-- Divisi PLN -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span class="text-xs text-gray-500">2.5%</span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Divisi PLN</p>
                    <p class="text-2xl font-bold text-gray-900">15</p>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Trends Chart -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Tren Magang</h3>
                    <div class="flex space-x-2">
                        <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-1"></div>
                            Mulai
                        </span>
                        <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-1"></div>
                            Selesai
                        </span>
                    </div>
                </div>
                <div class="h-64">
                    <canvas id="trendsChart"></canvas>
                </div>
            </div>

            <!-- Satisfaction Pie Chart -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Tingkat Kepuasan</h3>
                    <span class="text-sm text-gray-500">Rata-rata: 4.2/5</span>
                </div>
                <div class="h-64">
                    <canvas id="satisfactionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Insights Terbaru -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Insights Terbaru</h3>
                <div class="space-y-4">
                    <div class="bg-indigo-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-indigo-900 mb-2">Masa Magang</h4>
                        <div class="text-xl font-bold text-indigo-600">{{ $analytics['overview']['avg_duration'] }} hari</div>
                        <div class="text-xs text-indigo-600">Rata-rata durasi</div>
                    </div>
                    <div class="bg-emerald-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-emerald-900 mb-2">Status Aktif</h4>
                        <div class="text-xl font-bold text-emerald-600">70%</div>
                        <div class="text-xs text-emerald-600">Dari total peserta</div>
                    </div>
                    <div class="bg-rose-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-rose-900 mb-2">Completion Rate</h4>
                        <div class="text-xl font-bold text-rose-600">85%</div>
                        <div class="text-xs text-rose-600">Tingkat kelulusan</div>
                    </div>
                </div>
            </div>

            <!-- Aktivitas Hari Ini -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Hari Ini</h3>
                    <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-1 animate-pulse"></div>
                        Live
                    </span>
                </div>
                <div class="grid grid-cols-2 gap-3">
                    <div class="text-center bg-blue-50 rounded-lg p-3">
                        <div class="text-2xl font-bold text-blue-600">0</div>
                        <div class="text-xs text-blue-700">Baru</div>
                    </div>
                    <div class="text-center bg-green-50 rounded-lg p-3">
                        <div class="text-2xl font-bold text-green-600">0</div>
                        <div class="text-xs text-green-700">Mulai</div>
                    </div>
                    <div class="text-center bg-purple-50 rounded-lg p-3">
                        <div class="text-2xl font-bold text-purple-600">0</div>
                        <div class="text-xs text-purple-700">Selesai</div>
                    </div>
                    <div class="text-center bg-amber-50 rounded-lg p-3">
                        <div class="text-2xl font-bold text-amber-600">0%</div>
                        <div class="text-xs text-amber-700">Hadir</div>
                    </div>
                </div>
            </div>

            <!-- Perhatian Khusus -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Perhatian Khusus</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                        <div>
                            <div class="text-sm font-medium text-red-900">Berakhir Minggu Ini</div>
                            <div class="text-xs text-red-700">Perlu evaluasi</div>
                        </div>
                        <div class="text-xl font-bold text-red-600">0</div>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-amber-50 rounded-lg">
                        <div>
                            <div class="text-sm font-medium text-amber-900">Belum Nametag</div>
                            <div class="text-xs text-amber-700">Perlu tindak lanjut</div>
                        </div>
                        <div class="text-xl font-bold text-amber-600">0</div>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                        <div>
                            <div class="text-sm font-medium text-orange-900">Data Tidak Lengkap</div>
                            <div class="text-xs text-orange-700">Perlu update</div>
                        </div>
                        <div class="text-xl font-bold text-orange-600">0</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Real-time -->
        <div class="bg-white rounded-lg shadow-sm p-5 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Progress Real-time</h3>
                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-1 animate-pulse"></div>
                    Auto Update
                </span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @for($i = 0; $i < 8; $i++)
                <div class="flex items-center p-3 {{ $i < 2 ? 'bg-green-50' : ($i < 5 ? 'bg-yellow-50' : 'bg-red-50') }} rounded-lg">
                    <div class="w-8 h-8 {{ $i < 2 ? 'bg-green-500' : ($i < 5 ? 'bg-yellow-500' : 'bg-red-500') }} rounded-full flex items-center justify-center mr-3">
                        <span class="text-white text-xs font-bold">{{ ['AR', 'SN', 'DK', 'TR', 'CM', 'BF', 'FH', 'IA'][$i] }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-medium text-gray-900 truncate">{{ ['Ahmad Rizki', 'Siti Nurhaliza', 'Dedi Kurniawan', 'Teuku Rizal', 'Cut Meutia', 'Bayu Firmansyah', 'Fitri Handayani', 'Intan Ayuni'][$i] }}</h4>
                        <div class="text-xs {{ $i < 2 ? 'text-green-600' : ($i < 5 ? 'text-yellow-600' : 'text-red-600') }}">{{ $i < 2 ? 'Sesuai jadwal' : ($i < 5 ? 'Perlu perhatian' : 'Terlambat') }}</div>
                        <div class="text-xs text-gray-500">{{ ['TI', 'TI', 'Keuangan', 'Konstruksi', 'SDM', 'Maintenance', 'K3', 'Pemasaran'][$i] }}</div>
                    </div>
                    <div class="text-right">
                        <div class="text-lg font-bold {{ $i < 2 ? 'text-green-600' : ($i < 5 ? 'text-yellow-600' : 'text-red-600') }}">{{ [75, 68, 45, 38, 29, 95, 100, 100][$i] }}%</div>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center bg-indigo-50 rounded-lg p-4">
                <div class="text-2xl font-bold text-indigo-600">21</div>
                <div class="text-sm text-indigo-700">Rata-rata Umur</div>
            </div>
            <div class="text-center bg-emerald-50 rounded-lg p-4">
                <div class="text-2xl font-bold text-emerald-600">85%</div>
                <div class="text-sm text-emerald-700">Tingkat Selesai</div>
            </div>
            <div class="text-center bg-cyan-50 rounded-lg p-4">
                <div class="text-2xl font-bold text-cyan-600">Teknik</div>
                <div class="text-sm text-cyan-700">Prodi Populer</div>
            </div>
            <div class="text-center bg-green-50 rounded-lg p-4">
                <div class="text-2xl font-bold text-green-600">90%</div>
                <div class="text-sm text-green-700">WA Terverifikasi</div>
            </div>
        </div>
        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function refreshDashboard() {
    const button = event.target.closest('button');
    const originalText = button.innerHTML;
    
    button.innerHTML = `
        <svg class="w-4 h-4 mr-1 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
        Loading...
    `;
    button.disabled = true;
    
    setTimeout(() => {
        location.reload();
    }, 1500);
}

// Initialize Charts
document.addEventListener('DOMContentLoaded', function() {
    // Trends Chart
    const trendsCtx = document.getElementById('trendsChart').getContext('2d');
    new Chart(trendsCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu'],
            datasets: [{
                label: 'Mulai Magang',
                data: [12, 19, 15, 25, 22, 30, 28, 35],
                borderColor: '#3B82F6',
                backgroundColor: '#3B82F6',
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: '#3B82F6',
                tension: 0.4,
                fill: false
            }, {
                label: 'Selesai Magang',
                data: [8, 15, 12, 20, 18, 25, 24, 30],
                borderColor: '#10B981',
                backgroundColor: '#10B981',
                borderWidth: 2,
                pointRadius: 4,
                pointBackgroundColor: '#10B981',
                tension: 0.4,
                fill: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 11
                        },
                        color: '#6B7280'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(243, 244, 246, 0.8)',
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 11
                        },
                        color: '#6B7280'
                    }
                }
            }
        }
    });

    // Satisfaction Chart
    const satisfactionCtx = document.getElementById('satisfactionChart').getContext('2d');
    new Chart(satisfactionCtx, {
        type: 'doughnut',
        data: {
            labels: ['Sangat Puas', 'Puas', 'Cukup', 'Kurang'],
            datasets: [{
                data: [45, 35, 15, 5],
                backgroundColor: [
                    '#10B981',
                    '#3B82F6', 
                    '#F59E0B',
                    '#EF4444'
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 15,
                        font: {
                            size: 11
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection