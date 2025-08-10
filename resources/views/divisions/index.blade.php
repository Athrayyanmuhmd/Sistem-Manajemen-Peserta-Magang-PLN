@extends('layouts.pln-dashboard')

@section('title', 'Divisi PLN')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">Divisi PLN</h1>
            <p class="mt-2 text-sm text-gray-600">Kelola divisi dan unit kerja PLN UID Aceh</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('divisions.create') }}" class="btn-primary">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Divisi
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 mt-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 mt-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="mt-8 bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <div class="px-8 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Divisi PLN</h3>
                <div class="flex flex-col lg:flex-row items-stretch lg:items-center space-y-4 lg:space-y-0 lg:space-x-8">
                    <form method="GET" action="{{ route('divisions.index') }}" class="flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-8 w-full lg:w-auto">
                        <!-- Search Input -->
                        <div class="flex-1 lg:flex-initial">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari divisi..." class="w-full lg:w-64 px-6 py-4 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md">
                        </div>

                        <!-- Status Select -->
                        <div class="flex-1 lg:flex-initial">
                            <select name="status" class="w-full lg:w-40 px-6 py-4 border border-gray-300 rounded-lg text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md bg-white">
                                <option value="" class="text-gray-500">Semua Status</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex space-x-3">
                            <button type="submit" class="inline-flex items-center justify-center px-6 py-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg border border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                                </svg>
                                Filter
                            </button>
                            @if(request()->hasAny(['search', 'status']))
                                <a href="{{ route('divisions.index') }}" class="inline-flex items-center justify-center px-6 py-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if($divisions->count() > 0)
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-6">
            @foreach($divisions as $division)
            <div class="group bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-2 flex flex-col" style="min-height: 520px;">
                <!-- Card Header - Fixed Height -->
                <div class="relative" style="min-height: 100px;">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 px-6 py-4 h-full">
                        <div class="flex items-start justify-between h-full">
                            <div class="flex items-center space-x-3 flex-1 min-w-0">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg hover:shadow-xl transition-shadow duration-300 border-2 border-white">
                                        <span class="text-white font-extrabold text-base tracking-tight leading-none" style="text-shadow: 0 1px 3px rgba(0,0,0,0.5);">
                                            {{ $division->code }}
                                        </span>
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-base font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-300 leading-tight line-clamp-2" style="height: 2.5rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                        {{ $division->name }}
                                    </h3>
                                    <p class="text-sm text-gray-600 mt-1 truncate">{{ $division->head ?? 'Kepala Divisi: -' }}</p>
                                </div>
                            </div>
                            <div class="flex-shrink-0 ml-2">
                                @if($division->is_active)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 border border-gray-200">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                        </svg>
                                        Nonaktif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Body - Fixed Content Structure -->
                <div class="p-6 flex-1 flex flex-col justify-between" style="min-height: 300px;">
                    <div class="space-y-4">
                        <!-- Capacity Information - Fixed Height -->
                        <div style="min-height: 80px;">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Kapasitas Peserta</span>
                                <span class="text-sm font-bold text-gray-900">{{ $division->active_interns_count }}/{{ $division->capacity }}</span>
                            </div>
                            @php
                                $utilization = $division->capacity > 0 ? ($division->active_interns_count / $division->capacity) * 100 : 0;
                                
                                // Color coding sama seperti halaman peserta magang
                                if ($utilization == 0) {
                                    $barColor = '#9ca3af'; // gray-400
                                } elseif ($utilization <= 20) {
                                    $barColor = '#ef4444'; // red-500
                                } elseif ($utilization <= 40) {
                                    $barColor = '#f97316'; // orange-500
                                } elseif ($utilization <= 60) {
                                    $barColor = '#eab308'; // yellow-500
                                } elseif ($utilization <= 80) {
                                    $barColor = '#3b82f6'; // blue-500
                                } else {
                                    $barColor = '#10b981'; // emerald-500
                                }
                            @endphp
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="h-3 rounded-full transition-all duration-500 shadow-sm" style="width: {{ $utilization }}%; background-color: {{ $barColor }};"></div>
                            </div>
                            <div class="mt-2 flex justify-between text-xs">
                                <span class="text-gray-600">{{ number_format($utilization, 1) }}% utilisasi</span>
                                @if($utilization >= 95)
                                    <span class="text-blue-600 font-bold">Penuh</span>
                                @elseif($utilization >= 85)
                                    <span class="text-blue-600 font-semibold">Kritis</span>
                                @elseif($utilization >= 70)
                                    <span class="text-blue-600 font-semibold">Tinggi</span>
                                @elseif($utilization >= 50)
                                    <span class="text-blue-600 font-medium">Normal</span>
                                @elseif($utilization >= 25)
                                    <span class="text-blue-600 font-medium">Optimal</span>
                                @else
                                    <span class="text-blue-600 font-medium">Tersedia</span>
                                @endif
                            </div>
                        </div>

                        <!-- Statistics - Fixed Height -->
                        <div class="grid grid-cols-2 gap-4" style="min-height: 70px;">
                            <div class="text-center bg-blue-50 rounded-lg py-3 px-2 border border-blue-100">
                                <div class="text-xl font-bold text-blue-600">{{ number_format($division->interns_count) }}</div>
                                <div class="text-xs text-blue-600 font-medium">Total Peserta</div>
                            </div>
                            <div class="text-center bg-green-50 rounded-lg py-3 px-2 border border-green-100">
                                <div class="text-xl font-bold text-green-600">{{ number_format($division->active_interns_count) }}</div>
                                <div class="text-xs text-green-600 font-medium">Sedang Aktif</div>
                            </div>
                        </div>
                    </div>

                    <!-- Location - Fixed Height at Bottom of Body -->
                    <div style="min-height: 50px;" class="flex items-end">
                        @if($division->location)
                        <div class="w-full">
                            <div class="flex items-center justify-center p-3 bg-blue-50 rounded-lg border border-blue-100">
                                <svg class="h-4 w-4 mr-2 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm text-blue-700 font-medium truncate">{{ $division->location }}</span>
                            </div>
                        </div>
                        @else
                        <div class="w-full h-12"></div>
                        @endif
                    </div>
                </div>

                <!-- Card Footer - Fixed Height -->
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100" style="min-height: 120px;">
                    <div class="flex flex-col space-y-3 h-full justify-center">
                        <div class="flex space-x-2">
                            <a href="{{ route('divisions.show', $division) }}" class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-200 hover:border-blue-300 transition-all duration-200 group">
                                <svg class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat Detail
                            </a>
                            <a href="{{ route('divisions.edit', $division) }}" class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-amber-600 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 rounded-lg border border-amber-200 hover:border-amber-300 transition-all duration-200 group">
                                <svg class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Data
                            </a>
                        </div>
                        @if($division->interns_count == 0)
                        <form method="POST" action="{{ route('divisions.destroy', $division) }}" class="w-full" onsubmit="return confirm('Apakah Anda yakin ingin menghapus divisi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 rounded-lg border border-red-200 hover:border-red-300 transition-all duration-200 group">
                                <svg class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus Divisi
                            </button>
                        </form>
                        @else
                        <div class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-400 bg-gray-100 rounded-lg border border-gray-200 cursor-not-allowed" title="Tidak dapat menghapus divisi yang memiliki peserta">
                            <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Tidak Dapat Dihapus
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $divisions->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada divisi</h3>
            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan divisi PLN pertama.</p>
            <div class="mt-6">
                <a href="{{ route('divisions.create') }}" class="btn-primary">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Divisi PLN
                </a>
            </div>
        </div>
        @endif
    </div>
    </div>
</div>
@endsection