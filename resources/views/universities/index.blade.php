@extends('layouts.pln-dashboard')

@section('title', 'Universitas Partner')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-2xl font-semibold text-gray-900">Universitas Partner</h1>
                <p class="mt-2 text-sm text-gray-600">Kelola universitas mitra program magang PLN UID Aceh</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{ route('universities.create') }}" class="btn-primary">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Universitas
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <div class="px-8 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Universitas Partner</h3>
                <div class="flex flex-col lg:flex-row items-stretch lg:items-center space-y-4 lg:space-y-0 lg:space-x-8">
                    <form method="GET" action="{{ route('universities.index') }}" class="flex flex-col lg:flex-row space-y-4 lg:space-y-0 lg:space-x-8 w-full lg:w-auto">
                        <!-- Search Input -->
                        <div class="flex-1 lg:flex-initial">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari universitas..." class="w-full lg:w-72 px-6 py-4 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md">
                        </div>

                        <!-- Province Select -->
                        <div class="flex-1 lg:flex-initial">
                            <select name="province" class="w-full lg:w-48 px-6 py-4 border border-gray-300 rounded-lg text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md bg-white">
                                <option value="" class="text-gray-500">Semua Provinsi</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province }}" {{ request('province') === $province ? 'selected' : '' }}>
                                        {{ $province }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Status Select -->
                        <div class="flex-1 lg:flex-initial">
                            <select name="status" class="w-full lg:w-44 px-6 py-4 border border-gray-300 rounded-lg text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all duration-200 shadow-sm hover:shadow-md bg-white">
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
                            @if(request()->hasAny(['search', 'province', 'status']))
                                <a href="{{ route('universities.index') }}" class="inline-flex items-center justify-center px-6 py-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md">
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

        @if($universities->count() > 0)
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-6">
            @foreach($universities as $university)
            <div class="group bg-white shadow-sm border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl hover:border-blue-300 transition-all duration-300 transform hover:-translate-y-2 flex flex-col h-full">
                <!-- Card Header with Status Badge -->
                <div class="relative">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 px-6 py-4">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    @php
                                        $abbreviation = strtoupper(substr($university->short_name ?: $university->name, 0, 2));
                                    @endphp
                                    <div class="h-12 w-12 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg hover:shadow-xl transition-shadow duration-300 border-2 border-white">
                                        <span class="text-white font-extrabold text-base tracking-tight leading-none" style="text-shadow: 0 1px 3px rgba(0,0,0,0.5);">
                                            {{ $abbreviation }}
                                        </span>
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300 leading-tight">
                                        {{ $university->short_name ?: Str::limit($university->name, 20) }}
                                    </h3>
                                    <p class="text-sm text-gray-600 mt-0.5">{{ $university->city }}, {{ $university->province }}</p>
                                </div>
                            </div>
                            @if($university->is_active)
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

                <!-- Card Body -->
                <div class="p-6 flex-1 flex flex-col">
                    <!-- University Full Name -->
                    <div class="mb-4">
                        <h4 class="text-sm font-medium text-gray-800 leading-relaxed">{{ $university->name }}</h4>
                        @if($university->rector)
                            <p class="text-xs text-gray-500 mt-1 flex items-center">
                                <svg class="w-3 h-3 mr-1 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Rektor: {{ $university->rector }}
                            </p>
                        @endif
                    </div>

                    <!-- Statistics -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="text-center bg-blue-50 rounded-lg py-3 px-2 border border-blue-100">
                            <div class="text-xl font-bold text-blue-600">{{ number_format($university->interns_count) }}</div>
                            <div class="text-xs text-blue-600 font-medium">Total Peserta</div>
                        </div>
                        <div class="text-center bg-green-50 rounded-lg py-3 px-2 border border-green-100">
                            <div class="text-xl font-bold text-green-600">{{ number_format($university->active_interns_count) }}</div>
                            <div class="text-xs text-green-600 font-medium">Sedang Aktif</div>
                        </div>
                    </div>

                    <!-- Partnership Level Indicator -->
                    <div class="mt-auto">
                        @php
                            $partnershipLevel = '';
                            $partnershipStyle = '';
                            $partnershipIcon = '';
                            if ($university->interns_count >= 10) {
                                $partnershipLevel = 'Kemitraan Tinggi';
                                $partnershipStyle = 'bg-green-100 text-green-800 border-green-200';
                                $partnershipIcon = '<svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>';
                            } elseif ($university->interns_count >= 5) {
                                $partnershipLevel = 'Kemitraan Sedang';
                                $partnershipStyle = 'bg-blue-100 text-blue-800 border-blue-200';
                                $partnershipIcon = '<svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path></svg>';
                            } elseif ($university->interns_count > 0) {
                                $partnershipLevel = 'Kemitraan Rendah';
                                $partnershipStyle = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                $partnershipIcon = '<svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>';
                            } else {
                                $partnershipLevel = 'Belum Bermitra';
                                $partnershipStyle = 'bg-gray-100 text-gray-700 border-gray-200';
                                $partnershipIcon = '<svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>';
                            }
                        @endphp
                        <div class="flex justify-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $partnershipStyle }}">
                                {!! $partnershipIcon !!}
                                {{ $partnershipLevel }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 mt-auto">
                    <div class="flex flex-col space-y-3">
                        <div class="flex space-x-2">
                            <a href="{{ route('universities.show', $university) }}" class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-lg border border-blue-200 hover:border-blue-300 transition-all duration-200 group">
                                <svg class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Lihat Detail
                            </a>
                            <a href="{{ route('universities.edit', $university) }}" class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-amber-600 hover:text-amber-700 bg-amber-50 hover:bg-amber-100 rounded-lg border border-amber-200 hover:border-amber-300 transition-all duration-200 group">
                                <svg class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Data
                            </a>
                        </div>
                        @if($university->interns_count == 0)
                        <form method="POST" action="{{ route('universities.destroy', $university) }}" class="w-full" onsubmit="return confirm('Apakah Anda yakin ingin menghapus universitas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 rounded-lg border border-red-200 hover:border-red-300 transition-all duration-200 group">
                                <svg class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus Universitas
                            </button>
                        </form>
                        @else
                        <div class="w-full inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium text-gray-400 bg-gray-100 rounded-lg border border-gray-200 cursor-not-allowed" title="Tidak dapat menghapus universitas yang memiliki peserta">
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
            {{ $universities->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada universitas partner</h3>
            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan universitas mitra program magang.</p>
            <div class="mt-6">
                <a href="{{ route('universities.create') }}" class="btn-primary">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Universitas Partner
                </a>
            </div>
        </div>
        @endif
    </div>
    </div>
</div>
@endsection