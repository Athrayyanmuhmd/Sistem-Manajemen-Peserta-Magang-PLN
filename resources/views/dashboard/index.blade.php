@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('header')
    <div class="bg-blue-600 rounded-lg shadow-lg px-6 py-4 mb-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
            <div class="flex-1">
                <div class="flex items-center mb-2">
                    <div class="w-8 h-8 bg-blue-700 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                        </svg>
                    </div>
                    <span class="text-blue-100 text-sm font-medium">Dashboard Utama</span>
                </div>
                <h1 class="text-2xl font-bold text-white mb-1">Sistem Manajemen Magang</h1>
                <p class="text-blue-100 text-sm">Ringkasan sistem manajemen peserta magang PLN UID Aceh</p>
            </div>
            <div class="flex items-center space-x-3 mt-4 lg:mt-0">
                <div class="text-right">
                    <p class="text-sm text-blue-100">{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                    <p class="text-xs text-blue-200">{{ \Carbon\Carbon::now()->format('H:i') }} WIB</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Total Interns -->
        <div class="bg-white rounded-lg shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Total</span>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Peserta</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_interns']) }}</p>
            </div>
        </div>

        <!-- Active Interns -->
        <div class="bg-white rounded-lg shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Aktif</span>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Sedang Aktif</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['active_interns']) }}</p>
            </div>
        </div>

        <!-- Completed Interns -->
        <div class="bg-white rounded-lg shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="inline-flex items-center px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">Selesai</span>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Selesai</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['completed_interns']) }}</p>
            </div>
        </div>

        <!-- Pending Interns -->
        <div class="bg-white rounded-lg shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="inline-flex items-center px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Pending</span>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Menunggu</p>
                <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['pending_interns']) }}</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Department Progress Chart -->
        <div class="bg-white rounded-lg shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Progress Departemen</h3>
                <span class="text-sm text-gray-500">Real-time</span>
            </div>
            <div class="h-64">
                <canvas id="departmentChart"></canvas>
            </div>
        </div>

        <!-- Status Distribution -->
        <div class="bg-white rounded-lg shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Distribusi Status</h3>
                <span class="text-sm text-gray-500">Live Update</span>
            </div>
            <div class="h-64">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Interns -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Peserta Terbaru</h3>
                <a href="{{ route('interns.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                    Lihat Semua
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recent_interns as $intern)
                <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <div class="flex-shrink-0">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                            <span class="text-sm font-medium text-white">
                                {{ substr($intern->name, 0, 2) }}
                            </span>
                        </div>
                    </div>
                    <div class="ml-4 flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $intern->name }}</p>
                        <p class="text-sm text-gray-500 truncate">{{ $intern->university }}</p>
                        <p class="text-xs text-gray-400">{{ $intern->department->name ?? 'Belum ada departemen' }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $intern->status_badge }}">
                            {{ ucfirst($intern->status) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada peserta</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan peserta magang pertama.</p>
                    <div class="mt-6">
                        <a href="{{ route('interns.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Tambah Peserta
                        </a>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Department Overview -->
        <div class="bg-white rounded-lg shadow-sm p-5">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Ringkasan Departemen</h3>
                <a href="{{ route('departments.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                    Kelola
                </a>
            </div>
            <div class="space-y-4">
                @forelse($departments_with_interns as $dept)
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-medium text-gray-900">{{ Str::limit($dept['name'], 20) }}</h4>
                        <span class="text-sm text-gray-500">{{ $dept['active_count'] }}/{{ $dept['total_count'] }}</span>
                    </div>
                    @php
                        $utilization = $dept['total_count'] > 0 ? ($dept['active_count'] / $dept['total_count']) * 100 : 0;
                        $barColor = $utilization >= 80 ? 'bg-red-500' : ($utilization >= 60 ? 'bg-yellow-500' : 'bg-blue-500');
                    @endphp
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="{{ $barColor }} h-2 rounded-full transition-all duration-500" style="width: {{ min($utilization, 100) }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500">{{ number_format($utilization, 1) }}% kapasitas</p>
                </div>
                @empty
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada departemen</h3>
                    <p class="mt-1 text-sm text-gray-500">Tambahkan departemen untuk mengelola peserta.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-sm p-5">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('interns.create') }}" class="flex flex-col items-center justify-center px-6 py-8 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors aspect-square">
                <svg class="w-8 h-8 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="text-center leading-tight">Tambah Peserta</span>
            </a>
            
            <a href="{{ route('departments.index') }}" class="flex flex-col items-center justify-center px-6 py-8 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors aspect-square">
                <svg class="w-8 h-8 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span class="text-center leading-tight">Kelola Departemen</span>
            </a>
            
            <a href="{{ route('interns.index') }}" class="flex flex-col items-center justify-center px-6 py-8 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors aspect-square">
                <svg class="w-8 h-8 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <span class="text-center leading-tight">Lihat Laporan</span>
            </a>
            
            <a href="{{ route('analytics.index') }}" class="flex flex-col items-center justify-center px-6 py-8 text-sm font-medium text-purple-700 bg-purple-100 hover:bg-purple-200 rounded-lg transition-colors aspect-square">
                <svg class="w-8 h-8 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <span class="text-center leading-tight">Dashboard Analytics</span>
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Department Progress Chart
    const deptCtx = document.getElementById('departmentChart').getContext('2d');
    new Chart(deptCtx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($departments_with_interns as $dept)
                    '{{ Str::limit($dept["name"], 10) }}',
                @endforeach
            ],
            datasets: [{
                label: 'Aktif',
                data: [
                    @foreach($departments_with_interns as $dept)
                        {{ $dept['active_count'] }},
                    @endforeach
                ],
                backgroundColor: '#3B82F6',
                borderRadius: 4
            }, {
                label: 'Total',
                data: [
                    @foreach($departments_with_interns as $dept)
                        {{ $dept['total_count'] }},
                    @endforeach
                ],
                backgroundColor: '#E5E7EB',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            size: 12
                        }
                    }
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
                        }
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
                        }
                    }
                }
            }
        }
    });

    // Status Distribution Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Aktif', 'Selesai', 'Pending'],
            datasets: [{
                data: [
                    {{ $stats['active_interns'] }},
                    {{ $stats['completed_interns'] }},
                    {{ $stats['pending_interns'] }}
                ],
                backgroundColor: [
                    '#10B981',
                    '#8B5CF6',
                    '#F59E0B'
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