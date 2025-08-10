@extends('layouts.pln-dashboard')

@section('title', 'Dashboard Magang PLN UID Aceh')

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
                            <span class="text-blue-100 text-sm font-medium">Dashboard Magang PLN UID Aceh</span>
                        </div>
                        <h1 class="text-2xl font-bold text-white mb-1">Dashboard Operasional</h1>
                        <p class="text-blue-100 text-sm">Monitoring real-time dan manajemen harian program magang PLN UID Aceh</p>
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

        <!-- Key Metrics Row -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Total Peserta -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Total</span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Peserta</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_interns'] ?? 0) }}</p>
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
                    <p class="text-sm text-gray-600 mb-1">Peserta Aktif</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['active_interns'] ?? 0) }}</p>
                </div>
            </div>

            <!-- Universitas Partner -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                        </svg>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 bg-orange-100 text-orange-800 text-xs font-medium rounded-full">Partner</span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Universitas</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_universities'] ?? 0) }}</p>
                </div>
            </div>

            <!-- Divisi PLN -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <span class="inline-flex items-center px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">PLN</span>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Divisi PLN</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_divisions'] ?? 0) }}</p>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
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
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Insights Terbaru -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Insights Terbaru</h3>
                <div class="space-y-4">
                    <div class="bg-indigo-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-indigo-900 mb-2">Masa Magang</h4>
                        <div class="text-xl font-bold text-indigo-600">{{ $insights['duration_analysis']['avg_days'] ?? '90' }} hari</div>
                        <div class="text-xs text-indigo-600">Rata-rata durasi</div>
                    </div>
                    <div class="bg-emerald-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-emerald-900 mb-2">Status Aktif</h4>
                        <div class="text-xl font-bold text-emerald-600">{{ number_format(($stats['active_interns'] ?? 0) / max($stats['total_interns'] ?? 1, 1) * 100, 1) }}%</div>
                        <div class="text-xs text-emerald-600">Dari total peserta</div>
                    </div>
                    <div class="bg-rose-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-rose-900 mb-2">Completion Rate</h4>
                        <div class="text-xl font-bold text-rose-600">{{ $quick_stats['completion_rate'] ?? '85' }}%</div>
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
                        <div class="text-2xl font-bold text-blue-600">{{ $today_stats['new_interns'] ?? '0' }}</div>
                        <div class="text-xs text-blue-700">Baru</div>
                    </div>
                    <div class="text-center bg-green-50 rounded-lg p-3">
                        <div class="text-2xl font-bold text-green-600">{{ $today_stats['started_today'] ?? '0' }}</div>
                        <div class="text-xs text-green-700">Mulai</div>
                    </div>
                    <div class="text-center bg-purple-50 rounded-lg p-3">
                        <div class="text-2xl font-bold text-purple-600">{{ $today_stats['completed_today'] ?? '0' }}</div>
                        <div class="text-xs text-purple-700">Selesai</div>
                    </div>
                    <div class="text-center bg-amber-50 rounded-lg p-3">
                        <div class="text-2xl font-bold text-amber-600">{{ $today_stats['attendance_rate'] ?? '0' }}%</div>
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
                        <div class="text-xl font-bold text-red-600">{{ $urgent_actions['ending_this_week'] ?? '0' }}</div>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-amber-50 rounded-lg">
                        <div>
                            <div class="text-sm font-medium text-amber-900">Belum Nametag</div>
                            <div class="text-xs text-amber-700">Perlu tindak lanjut</div>
                        </div>
                        <div class="text-xl font-bold text-amber-600">{{ $urgent_actions['missing_nametag'] ?? '0' }}</div>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-orange-50 rounded-lg">
                        <div>
                            <div class="text-sm font-medium text-orange-900">Data Tidak Lengkap</div>
                            <div class="text-xs text-orange-700">Perlu update</div>
                        </div>
                        <div class="text-xl font-bold text-orange-600">{{ $urgent_actions['incomplete_data'] ?? '0' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity & Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Recent Interns Activity -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Aktivitas Peserta Terkini</h3>
                    <a href="{{ route('interns.index') }}" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                        Lihat Semua
                    </a>
                </div>
                <div class="space-y-4">
                    @if(isset($recent_activities) && count($recent_activities) > 0)
                        @foreach($recent_activities as $activity)
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-medium text-white">
                                        {{ substr($activity['name'], 0, 2) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-4 flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $activity['name'] }}</p>
                                <p class="text-sm text-gray-500 truncate">{{ $activity['action'] }}</p>
                                <p class="text-xs text-gray-400">{{ $activity['university'] ?? 'N/A' }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $activity['status_color'] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $activity['status'] }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Belum ada aktivitas</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions Panel -->
            <div class="bg-white rounded-lg shadow-sm p-5">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                <div class="grid grid-cols-2 gap-4">
                    <!-- Row 1 -->
                    <a href="{{ route('interns.create') }}" class="flex flex-col items-center justify-center px-4 py-6 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors aspect-square">
                        <svg class="w-6 h-6 mb-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span class="text-center leading-tight">Tambah Peserta</span>
                    </a>
                    
                    <a href="{{ route('departments.index') }}" class="flex flex-col items-center justify-center px-4 py-6 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors aspect-square">
                        <svg class="w-6 h-6 mb-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="text-center leading-tight">Kelola Departemen</span>
                    </a>
                    
                    <!-- Row 2 -->
                    <a href="{{ route('divisions.index') }}" class="flex flex-col items-center justify-center px-4 py-6 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors aspect-square">
                        <svg class="w-6 h-6 mb-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="text-center leading-tight">Kelola Divisi PLN</span>
                    </a>
                    
                    <a href="{{ route('interns.index') }}" class="flex flex-col items-center justify-center px-4 py-6 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors aspect-square">
                        <svg class="w-6 h-6 mb-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="text-center leading-tight">Lihat Laporan</span>
                    </a>
                    
                </div>
                
                <!-- Row 3 - Full Width Analytics -->
                <div class="mt-4">
                    <a href="{{ route('analytics.index') }}" class="w-full flex flex-col items-center justify-center px-4 py-6 text-sm font-medium text-purple-700 bg-purple-100 hover:bg-purple-200 rounded-lg transition-colors">
                        <svg class="w-6 h-6 mb-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span class="text-center leading-tight">Dashboard Analytics</span>
                    </a>
                </div>
                
                <!-- System Health Indicator -->
                <div class="mt-4 p-3 bg-green-50 rounded-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="text-sm font-medium text-green-900">Status Sistem</h4>
                            <p class="text-xs text-green-700">Semua layanan berjalan normal</p>
                        </div>
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Operational Intelligence Section - Full Width -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Insight Operasional Hari Ini</h3>
            
            <!-- Daily Highlights -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-blue-900 mb-3">Kapasitas Peserta</h4>
                        <div class="space-y-3">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-900">{{ $stats['active_interns'] ?? 0 }}</div>
                                <div class="text-xs text-blue-700 uppercase tracking-wide">Peserta Aktif</div>
                            </div>
                            <div class="border-t border-blue-200 pt-3">
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-blue-600">Utilizzasi:</span>
                                    <span class="font-medium text-blue-800">{{ $stats['capacity_utilization'] ?? 0 }}%</span>
                                </div>
                                <!-- Progress Bar -->
                                <div class="w-full bg-blue-200 rounded-full h-3">
                                    <div class="h-3 rounded-full transition-all duration-500 
                                        @php
                                            $utilization = $stats['capacity_utilization'] ?? 0;
                                            if ($utilization >= 90) echo 'bg-red-500';
                                            elseif ($utilization >= 75) echo 'bg-orange-500';
                                            elseif ($utilization >= 50) echo 'bg-yellow-500';
                                            elseif ($utilization >= 25) echo 'bg-blue-500';
                                            else echo 'bg-green-500';
                                        @endphp" 
                                        style="width: {{ min($stats['capacity_utilization'] ?? 0, 100) }}%">
                                    </div>
                                </div>
                                <div class="flex justify-between text-xs mt-1">
                                    <span class="text-blue-500">0%</span>
                                    <span class="text-blue-500">100%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-green-900 mb-3">Performance Score</h4>
                        <div class="space-y-3">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-900">{{ number_format($charts['performance_metrics']['avg_satisfaction'] ?? 4.2, 1) }}</div>
                                <div class="text-xs text-green-700 uppercase tracking-wide">Kepuasan (1-5)</div>
                            </div>
                            <div class="border-t border-green-200 pt-2">
                                <div class="flex justify-between text-xs">
                                    <span class="text-green-600">Status:</span>
                                    <span class="font-medium text-green-800">
                                        @if(($charts['performance_metrics']['avg_satisfaction'] ?? 0) >= 4.0)
                                            Sangat Baik
                                        @elseif(($charts['performance_metrics']['avg_satisfaction'] ?? 0) >= 3.0)
                                            Baik
                                        @else
                                            Perlu Perbaikan
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-purple-900 mb-3">Completion Rate</h4>
                        <div class="space-y-3">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-900">{{ $stats['completion_rate'] ?? 0 }}%</div>
                                <div class="text-xs text-purple-700 uppercase tracking-wide">Tingkat Selesai</div>
                            </div>
                            <div class="border-t border-purple-200 pt-2">
                                <div class="flex justify-between text-xs">
                                    <span class="text-purple-600">Selesai:</span>
                                    <span class="font-medium text-purple-800">{{ $progress_highlights['progress_summary']['completing_this_week'] ?? 0 }} orang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-orange-50 to-red-50 rounded-lg p-4">
                        <h4 class="text-sm font-medium text-orange-900 mb-3">Alert Status</h4>
                        <div class="space-y-3">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-orange-900">{{ ($progress_highlights['progress_summary']['overdue'] ?? 0) + ($progress_highlights['progress_summary']['at_risk'] ?? 0) }}</div>
                                <div class="text-xs text-orange-700 uppercase tracking-wide">Perlu Perhatian</div>
                            </div>
                            <div class="border-t border-orange-200 pt-2">
                                <div class="flex justify-between text-xs">
                                    <span class="text-orange-600">Status:</span>
                                    <span class="font-medium text-orange-800">
                                        @if((($progress_highlights['progress_summary']['overdue'] ?? 0) + ($progress_highlights['progress_summary']['at_risk'] ?? 0)) > 0)
                                            Perlu Tindakan
                                        @else
                                            Normal
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>

        <!-- Real-time Activity Feed & Progress Tracking -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Recent Activity Feed -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terkini</h3>
                    <div class="flex items-center text-xs text-green-600">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                        Live
                    </div>
                </div>
                
                <div class="space-y-3 max-h-64 overflow-y-auto">
                    @if(isset($recent_activity))
                        @foreach($recent_activity->take(8) as $activity)
                            <div class="flex items-start space-x-3 p-2 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ $activity['name'] }}</p>
                                        <span class="text-xs text-gray-500">{{ $activity['time'] }}</span>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1">
                                        Bergabung di {{ $activity['division'] }} • {{ $activity['university'] }}
                                    </p>
                                    <div class="flex items-center mt-1">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium 
                                            @if($activity['status'] == 'active') bg-green-100 text-green-800
                                            @elseif($activity['status'] == 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($activity['status']) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center text-gray-500 py-4">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <p class="text-sm">Belum ada aktivitas terbaru</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Progress Tracking -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Progress Tracking</h3>
                
                <div class="space-y-4">
                    <!-- Critical Items -->
                    @if(isset($progress_highlights['at_risk']) && $progress_highlights['at_risk']->count() > 0)
                        <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-medium text-red-900">Perlu Perhatian Khusus</h4>
                                <span class="text-xs bg-red-200 text-red-800 px-2 py-1 rounded-full">{{ $progress_highlights['at_risk']->count() }}</span>
                            </div>
                            @foreach($progress_highlights['at_risk']->take(3) as $intern)
                                <div class="flex items-center justify-between text-sm text-red-700 py-1">
                                    <span class="truncate">{{ $intern->name }}</span>
                                    <span class="text-xs">{{ $intern->division->name ?? 'N/A' }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    
                    <!-- Ending Soon -->
                    @if(isset($progress_highlights['ending_soon']) && $progress_highlights['ending_soon']->count() > 0)
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-medium text-yellow-900">Selesai 2 Minggu ke Depan</h4>
                                <span class="text-xs bg-yellow-200 text-yellow-800 px-2 py-1 rounded-full">{{ $progress_highlights['ending_soon']->count() }}</span>
                            </div>
                            @foreach($progress_highlights['ending_soon']->take(3) as $intern)
                                <div class="flex items-center justify-between text-sm text-yellow-700 py-1">
                                    <span class="truncate">{{ $intern->name }}</span>
                                    <span class="text-xs">{{ $intern->end_date ? \Carbon\Carbon::parse($intern->end_date)->format('d M') : 'N/A' }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    
                    <!-- Starting Soon -->
                    @if(isset($progress_highlights['starting_soon']) && $progress_highlights['starting_soon']->count() > 0)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-medium text-blue-900">Mulai Minggu Ini</h4>
                                <span class="text-xs bg-blue-200 text-blue-800 px-2 py-1 rounded-full">{{ $progress_highlights['starting_soon']->count() }}</span>
                            </div>
                            @foreach($progress_highlights['starting_soon']->take(3) as $intern)
                                <div class="flex items-center justify-between text-sm text-blue-700 py-1">
                                    <span class="truncate">{{ $intern->name }}</span>
                                    <span class="text-xs">{{ $intern->start_date ? \Carbon\Carbon::parse($intern->start_date)->format('d M') : 'N/A' }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    
                    <!-- On Track Summary -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-medium text-green-900">Berjalan Sesuai Rencana</h4>
                                <p class="text-xs text-green-700">{{ $progress_highlights['progress_summary']['on_track'] ?? 0 }} peserta dalam jalur yang benar</p>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-green-900">{{ number_format((($progress_highlights['progress_summary']['on_track'] ?? 0) / max(($stats['active_interns'] ?? 1), 1)) * 100, 0) }}%</div>
                                <div class="text-xs text-green-700">Success Rate</div>
                            </div>
                        </div>
                    </div>
                </div>
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
    // Department Progress Chart
    const deptCtx = document.getElementById('departmentChart').getContext('2d');
    new Chart(deptCtx, {
        type: 'bar',
        data: {
            labels: [
                @if(isset($departmental_overview))
                    @foreach($departmental_overview as $dept)
                        '{{ Str::limit($dept["name"], 10) }}',
                    @endforeach
                @endif
            ],
            datasets: [{
                label: 'Aktif',
                data: [
                    @if(isset($departmental_overview))
                        @foreach($departmental_overview as $dept)
                            {{ $dept['active'] }},
                        @endforeach
                    @endif
                ],
                backgroundColor: '#3B82F6',
                borderRadius: 4
            }, {
                label: 'Total',
                data: [
                    @if(isset($departmental_overview))
                        @foreach($departmental_overview as $dept)
                            {{ $dept['total'] }},
                        @endforeach
                    @endif
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
                    {{ $stats['active_interns'] ?? 0 }},
                    {{ $insights['status_breakdown']['completed'] ?? 0 }},
                    {{ $insights['status_breakdown']['pending'] ?? 0 }}
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