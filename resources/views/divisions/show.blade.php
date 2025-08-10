@extends('layouts.pln-dashboard')

@section('title', 'Detail Divisi')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">Detail Divisi</h1>
            <p class="mt-2 text-sm text-gray-600">Informasi lengkap divisi {{ $division->name }}</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none space-x-2">
            <a href="{{ route('divisions.edit', $division) }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                Edit
            </a>
            <a href="{{ route('divisions.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mt-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-8">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
            <!-- Header -->
            <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-16 w-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-blue-600">{{ $division->code }}</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $division->name }}</h2>
                        <p class="text-gray-600">{{ $division->head ?: 'Kepala Divisi: Belum ditentukan' }}</p>
                        <div class="flex items-center mt-1">
                            @if($division->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-green-800 bg-green-100">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-gray-800 bg-gray-100">
                                    Nonaktif
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6 bg-gray-50">
                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-2xl font-bold text-gray-900">{{ $stats['total_interns'] }}</div>
                            <div class="text-sm text-gray-500">Total Peserta</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-2xl font-bold text-gray-900">{{ $stats['active_interns'] }}</div>
                            <div class="text-sm text-gray-500">Sedang Aktif</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 bg-purple-500 rounded-full flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['capacity_utilization'], 1) }}%</div>
                            <div class="text-sm text-gray-500">Utilisasi Kapasitas</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="h-8 w-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-3">
                            <div class="text-2xl font-bold text-gray-900">{{ number_format($stats['avg_satisfaction'], 1) }}</div>
                            <div class="text-sm text-gray-500">Rata-rata Kepuasan</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Division Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Divisi</h3>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-3 border border-gray-200">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Kode Divisi:</span>
                                <span class="text-gray-900 font-medium">{{ $division->code }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Kapasitas:</span>
                                <span class="text-gray-900 font-medium">{{ $division->capacity }} peserta</span>
                            </div>
                            @if($division->location)
                            <div class="flex justify-between">
                                <span class="text-gray-500">Lokasi:</span>
                                <span class="text-gray-900">{{ $division->location }}</span>
                            </div>
                            @endif
                            @if($division->contact_email)
                            <div class="flex justify-between">
                                <span class="text-gray-500">Email:</span>
                                <span class="text-gray-900">{{ $division->contact_email }}</span>
                            </div>
                            @endif
                            @if($division->contact_phone)
                            <div class="flex justify-between">
                                <span class="text-gray-500">Telepon:</span>
                                <span class="text-gray-900">{{ $division->contact_phone }}</span>
                            </div>
                            @endif
                        </div>

                        @if($division->description)
                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Deskripsi</h3>
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <p class="text-gray-900">{{ $division->description }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Capacity Utilization -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Utilisasi Kapasitas</h3>
                        <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-gray-500">Terisi</span>
                                <span class="text-gray-900">{{ $stats['active_interns'] }}/{{ $division->capacity }}</span>
                            </div>
                            @php
                                $utilization = $stats['capacity_utilization'];
                                $utilizationColor = $utilization >= 90 ? 'bg-red-500' : ($utilization >= 70 ? 'bg-yellow-500' : 'bg-green-500');
                            @endphp
                            <div class="w-full bg-gray-200 rounded-full h-4">
                                <div class="h-4 rounded-full {{ $utilizationColor }}" style="width: {{ min($utilization, 100) }}%"></div>
                            </div>
                            <div class="mt-2 text-sm text-gray-500">
                                Utilisasi: {{ number_format($utilization, 1) }}%
                            </div>
                        </div>

                        @if($stats['avg_completion'] > 0)
                        <div class="mt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Rata-rata Penyelesaian</h3>
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-gray-500">Progress</span>
                                    <span class="text-gray-900">{{ number_format($stats['avg_completion'], 1) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $stats['avg_completion'] }}%"></div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Recent Interns -->
                @if($division->interns->count() > 0)
                <div class="mt-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Peserta Magang Terbaru</h3>
                    <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Universitas</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                                        <th class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($division->interns as $intern)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center">
                                                        <span class="text-white text-xs font-medium">{{ substr($intern->name, 0, 2) }}</span>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $intern->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $intern->major }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $intern->university->short_name ?? $intern->university->name ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusColors = [
                                                    'pending' => 'bg-yellow-500',
                                                    'active' => 'bg-green-500',
                                                    'completed' => 'bg-blue-500',
                                                    'terminated' => 'bg-red-500'
                                                ];
                                                $statusLabels = [
                                                    'pending' => 'Pending',
                                                    'active' => 'Aktif',
                                                    'completed' => 'Selesai',
                                                    'terminated' => 'Dihentikan'
                                                ];
                                            @endphp
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium text-white {{ $statusColors[$intern->status] ?? 'bg-gray-500' }}">
                                                {{ $statusLabels[$intern->status] ?? ucfirst($intern->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $intern->completion_percentage ?? 0 }}%
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('interns.show', $intern) }}" class="text-blue-600 hover:text-blue-800">
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    @if($division->interns_count > 10)
                    <div class="mt-4 text-center">
                        <a href="{{ route('interns.index', ['division' => $division->id]) }}" class="inline-flex items-center text-sm text-blue-600 hover:text-blue-800">
                            Lihat semua {{ $division->interns_count }} peserta
                            <svg class="ml-1 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection