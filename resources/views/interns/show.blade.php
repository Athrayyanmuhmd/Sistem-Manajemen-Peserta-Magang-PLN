@extends('layouts.pln-dashboard')

@section('title', 'Detail Peserta Magang')

@section('content')
<div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">Detail Peserta Magang</h1>
            <p class="mt-2 text-sm text-gray-600">Informasi lengkap peserta magang</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none space-x-2">
            <a href="{{ route('interns.edit', $intern) }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-gray-900 shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                Edit
            </a>
            <a href="{{ route('interns.index') }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="mt-8">
        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-16 w-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-gray-900">{{ substr($intern->name, 0, 1) }}</span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $intern->name }}</h2>
                        <p class="text-blue-100">{{ $intern->university->name ?? 'Universitas tidak diketahui' }}</p>
                        <div class="flex items-center mt-1">
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
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium text-gray-900 {{ $statusColors[$intern->status] ?? 'bg-gray-500' }}">
                                {{ $statusLabels[$intern->status] ?? ucfirst($intern->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-6">
                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                    <!-- Personal Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pribadi</h3>
                        <div class="bg-gray-50 rounded-lg border border-gray-200 p-4 space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Email:</span>
                                <span class="text-gray-900">{{ $intern->email }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Telepon:</span>
                                <span class="text-gray-900">{{ $intern->phone ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">NIM/NIS:</span>
                                <span class="text-gray-900">{{ $intern->student_id }}</span>
                            </div>
                            @if($intern->address)
                            <div>
                                <span class="text-gray-600">Alamat:</span>
                                <p class="text-gray-900 mt-1">{{ $intern->address }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Akademik</h3>
                        <div class="bg-gray-50 rounded-lg border border-gray-200 p-4 space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Universitas:</span>
                                <span class="text-gray-900">{{ $intern->university->short_name ?? $intern->university->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Program Studi:</span>
                                <span class="text-gray-900">{{ $intern->major }}</span>
                            </div>
                            @if($intern->university && $intern->university->city)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kota:</span>
                                <span class="text-gray-900">{{ $intern->university->city }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Internship Information -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Magang</h3>
                        <div class="bg-gray-50 rounded-lg border border-gray-200 p-4 space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Department:</span>
                                <span class="text-gray-900">{{ $intern->department->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Divisi:</span>
                                <span class="text-gray-900">{{ $intern->division->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pembimbing:</span>
                                <span class="text-gray-900">{{ $intern->supervisor ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Mulai:</span>
                                <span class="text-gray-900">{{ $intern->start_date ? $intern->start_date->format('d M Y') : '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal Selesai:</span>
                                <span class="text-gray-900">{{ $intern->end_date ? $intern->end_date->format('d M Y') : '-' }}</span>
                            </div>
                            @if($intern->project_assigned)
                            <div>
                                <span class="text-gray-600">Proyek:</span>
                                <p class="text-gray-900 mt-1">{{ $intern->project_assigned }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Progress & Performance -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Progress & Performa</h3>
                        <div class="bg-gray-50 rounded-lg border border-gray-200 p-4 space-y-4">
                            @if($intern->completion_percentage !== null)
                            <div>
                                <div class="flex justify-between mb-1">
                                    <span class="text-gray-600">Persentase Penyelesaian:</span>
                                    <span class="text-gray-900">{{ $intern->completion_percentage }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $intern->completion_percentage }}%"></div>
                                </div>
                            </div>
                            @endif

                            @if($intern->satisfaction_score)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Skor Kepuasan:</span>
                                <div class="flex items-center">
                                    <div class="flex space-x-1 mr-2">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="h-4 w-4 {{ $i <= $intern->satisfaction_score ? 'text-yellow-400' : 'text-gray-500' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="text-gray-900">{{ number_format($intern->satisfaction_score, 1) }}</span>
                                </div>
                            </div>
                            @endif

                            @if($intern->start_date && $intern->end_date)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Durasi:</span>
                                <span class="text-gray-900">{{ $intern->getDurationAttribute() }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Emergency Contact -->
                    @if($intern->emergency_contact || $intern->emergency_phone)
                    <div class="xl:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Kontak Darurat</h3>
                        <div class="bg-gray-50 rounded-lg border border-gray-200 p-4 space-y-3">
                            @if($intern->emergency_contact)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nama:</span>
                                <span class="text-gray-900">{{ $intern->emergency_contact }}</span>
                            </div>
                            @endif
                            @if($intern->emergency_phone)
                            <div class="flex justify-between">
                                <span class="text-gray-600">Telepon:</span>
                                <span class="text-gray-900">{{ $intern->emergency_phone }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Additional Information -->
                    @if($intern->notes)
                    <div class="xl:col-span-3">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Catatan</h3>
                        <div class="bg-gray-50 rounded-lg border border-gray-200 p-4">
                            <p class="text-gray-900">{{ $intern->notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex justify-between items-center text-sm text-gray-500">
                    <span>Dibuat: {{ $intern->created_at->format('d M Y, H:i') }}</span>
                    <span>Diperbarui: {{ $intern->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection