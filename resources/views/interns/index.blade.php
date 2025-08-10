@extends('layouts.pln-dashboard')

@section('title', 'Peserta Magang')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">Peserta Magang</h1>
            <p class="mt-2 text-sm text-gray-600">Kelola data seluruh peserta magang PLN UID Aceh</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('interns.create') }}" class="btn-primary">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Peserta
            </a>
        </div>
    </div>

    <div class="mt-8 bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <h3 class="text-lg font-semibold text-gray-900">Daftar Peserta Magang</h3>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
                    <input type="text" placeholder="Cari peserta..." class="form-input max-w-xs">
                    <select class="form-select">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="active">Aktif</option>
                        <option value="completed">Selesai</option>
                        <option value="terminated">Dihentikan</option>
                    </select>
                </div>
            </div>
        </div>

        @if($interns->count() > 0)
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Peserta
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Universitas
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Divisi
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Periode
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Progress
                        </th>
                        <th scope="col" class="px-6 py-4 text-left text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-4 text-right text-sm font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($interns as $intern)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-6">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12">
                                    <div class="h-12 w-12 rounded-full bg-blue-600 flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">
                                            {{ substr($intern->name, 0, 2) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-4 min-w-0 flex-1">
                                    <div class="text-sm font-medium text-gray-900 truncate">{{ $intern->name }}</div>
                                    <div class="text-sm text-gray-500 truncate">{{ $intern->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-6">
                            <div class="text-sm text-gray-900 font-medium">{{ $intern->university->short_name ?? Str::limit($intern->university->name ?? '-', 30) }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($intern->major, 35) }}</div>
                        </td>
                        <td class="px-6 py-6">
                            <div class="text-sm text-gray-900 font-medium">{{ Str::limit($intern->division->name ?? '-', 25) }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($intern->department->name ?? '-', 25) }}</div>
                        </td>
                        <td class="px-6 py-6 text-sm text-gray-900">
                            <div class="font-medium">{{ $intern->start_date?->format('d M Y') }}</div>
                            <div class="text-gray-500">{{ $intern->end_date?->format('d M Y') }}</div>
                        </td>
                        <td class="px-6 py-6">
                            @if($intern->completion_percentage !== null)
                            <div class="w-full">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-gray-900 font-medium">{{ $intern->completion_percentage }}%</span>
                                </div>
                                @php
                                    $progress = $intern->completion_percentage;
                                    if ($progress == 0) {
                                        $barColor = '#9ca3af'; // gray-400
                                    } elseif ($progress <= 20) {
                                        $barColor = '#ef4444'; // red-500
                                    } elseif ($progress <= 40) {
                                        $barColor = '#f97316'; // orange-500
                                    } elseif ($progress <= 60) {
                                        $barColor = '#eab308'; // yellow-500
                                    } elseif ($progress <= 80) {
                                        $barColor = '#84cc16'; // lime-500
                                    } else {
                                        $barColor = '#22c55e'; // green-500
                                    }
                                @endphp
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="h-3 rounded-full transition-all duration-500 shadow-sm" style="width: {{ $intern->completion_percentage }}%; background-color: {{ $barColor }};"></div>
                                </div>
                            </div>
                            @else
                            <span class="text-gray-400 text-sm">Belum dimulai</span>
                            @endif
                        </td>
                        <td class="px-6 py-6 text-center">
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
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white {{ $statusColors[$intern->status] ?? 'bg-gray-500' }}">
                                {{ $statusLabels[$intern->status] ?? ucfirst($intern->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-6 text-right">
                            <div class="flex items-center justify-end space-x-3">
                                <a href="{{ route('interns.show', $intern) }}" class="inline-flex items-center px-3 py-1 text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-md transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat
                                </a>
                                <a href="{{ route('interns.edit', $intern) }}" class="inline-flex items-center px-3 py-1 text-sm text-yellow-600 hover:text-yellow-800 hover:bg-yellow-50 rounded-md transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('interns.destroy', $intern) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 text-sm text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="lg:hidden space-y-4">
            @foreach($interns as $intern)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center">
                        <div class="h-12 w-12 rounded-full bg-blue-600 flex items-center justify-center mr-4">
                            <span class="text-sm font-medium text-white">
                                {{ substr($intern->name, 0, 2) }}
                            </span>
                        </div>
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $intern->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $intern->email }}</p>
                        </div>
                    </div>
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
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white {{ $statusColors[$intern->status] ?? 'bg-gray-500' }}">
                        {{ $statusLabels[$intern->status] ?? ucfirst($intern->status) }}
                    </span>
                </div>
                
                <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                    <div>
                        <dt class="font-medium text-gray-500">Universitas</dt>
                        <dd class="text-gray-900 mt-1">{{ $intern->university->short_name ?? Str::limit($intern->university->name ?? '-', 25) }}</dd>
                        <dd class="text-gray-500 text-xs">{{ Str::limit($intern->major, 30) }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">Divisi</dt>
                        <dd class="text-gray-900 mt-1">{{ Str::limit($intern->division->name ?? '-', 25) }}</dd>
                        <dd class="text-gray-500 text-xs">{{ Str::limit($intern->department->name ?? '-', 30) }}</dd>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm mb-4">
                    <div>
                        <dt class="font-medium text-gray-500">Periode</dt>
                        <dd class="text-gray-900 mt-1">{{ $intern->start_date?->format('d M Y') }}</dd>
                        <dd class="text-gray-500 text-xs">{{ $intern->end_date?->format('d M Y') }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">Progress</dt>
                        @if($intern->completion_percentage !== null)
                        <dd class="mt-1">
                            @php
                                $progress = $intern->completion_percentage;
                                if ($progress == 0) {
                                    $barColor = '#9ca3af'; // gray-400
                                } elseif ($progress <= 20) {
                                    $barColor = '#ef4444'; // red-500
                                } elseif ($progress <= 40) {
                                    $barColor = '#f97316'; // orange-500
                                } elseif ($progress <= 60) {
                                    $barColor = '#eab308'; // yellow-500
                                } elseif ($progress <= 80) {
                                    $barColor = '#84cc16'; // lime-500
                                } else {
                                    $barColor = '#22c55e'; // green-500
                                }
                            @endphp
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="h-2.5 rounded-full transition-all duration-500 shadow-sm" style="width: {{ $intern->completion_percentage }}%; background-color: {{ $barColor }};"></div>
                                    </div>
                                </div>
                                <span class="ml-2 text-sm font-medium text-gray-900">{{ $intern->completion_percentage }}%</span>
                            </div>
                        </dd>
                        @else
                        <dd class="text-gray-400 mt-1">Belum dimulai</dd>
                        @endif
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('interns.show', $intern) }}" class="inline-flex items-center px-3 py-1 text-sm text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-md">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Lihat
                    </a>
                    <a href="{{ route('interns.edit', $intern) }}" class="inline-flex items-center px-3 py-1 text-sm text-yellow-600 hover:text-yellow-800 hover:bg-yellow-50 rounded-md">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit
                    </a>
                    <form method="POST" action="{{ route('interns.destroy', $intern) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus peserta ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-1 text-sm text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $interns->links() }}
        </div>
        @else
        <div class="text-center py-12 w-full">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada peserta magang</h3>
            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan peserta magang pertama.</p>
            <div class="mt-6">
                <a href="{{ route('interns.create') }}" class="btn-primary">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Tambah Peserta Magang
                </a>
            </div>
        </div>
        @endif
    </div>
    </div>
</div>
@endsection