@extends('layouts.pln-dashboard')

@section('title', 'Tambah Peserta Magang')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Simple Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Peserta Magang</h1>
                <p class="mt-1 text-sm text-gray-600">Masukkan data lengkap peserta magang baru</p>
            </div>
            <a href="{{ route('interns.index') }}" class="btn-secondary">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="bg-white shadow rounded-lg border border-gray-200">
        <form action="{{ route('interns.store') }}" method="POST" class="p-6 space-y-8">
            @csrf
                    
            <!-- Personal Information -->
            <div>
                <div class="border-b border-gray-200 pb-5 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Pribadi</h3>
                    <p class="mt-2 text-sm text-gray-600">Data personal dan identitas peserta magang</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror" 
                            required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-300 @enderror" 
                            required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="student_id" class="block text-sm font-medium text-gray-700">NIM/NIS *</label>
                        <input type="text" name="student_id" id="student_id" value="{{ old('student_id') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('student_id') border-red-300 @enderror" 
                            required>
                        @error('student_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-8">
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="address" id="address" rows="3" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('address') }}</textarea>
                </div>
            </div>

            <!-- Academic Information -->
            <div>
                <div class="border-b border-gray-200 pb-5 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Akademik</h3>
                    <p class="mt-2 text-sm text-gray-600">Data universitas dan program studi</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="university_id" class="block text-sm font-medium text-gray-700">Universitas *</label>
                        <select name="university_id" id="university_id" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('university_id') border-red-300 @enderror" 
                            required>
                            <option value="">Pilih Universitas</option>
                            @foreach($universities as $university)
                                <option value="{{ $university->id }}" {{ old('university_id') == $university->id ? 'selected' : '' }}>
                                    {{ $university->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('university_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="major" class="block text-sm font-medium text-gray-700">Program Studi *</label>
                        <input type="text" name="major" id="major" value="{{ old('major') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('major') border-red-300 @enderror" 
                            required>
                        @error('major')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Internship Information -->
            <div>
                <div class="border-b border-gray-200 pb-5 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Magang</h3>
                    <p class="mt-2 text-sm text-gray-600">Penempatan dan detail program magang</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="department_id" class="block text-sm font-medium text-gray-700">Department *</label>
                        <select name="department_id" id="department_id" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('department_id') border-red-300 @enderror" 
                            required>
                            <option value="">Pilih Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="division_id" class="block text-sm font-medium text-gray-700">Divisi *</label>
                        <select name="division_id" id="division_id" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('division_id') border-red-300 @enderror" 
                            required>
                            <option value="">Pilih Divisi</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                    {{ $division->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('division_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="supervisor" class="block text-sm font-medium text-gray-700">Pembimbing</label>
                        <input type="text" name="supervisor" id="supervisor" value="{{ old('supervisor') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                        <select name="status" id="status" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-300 @enderror" 
                            required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="terminated" {{ old('status') == 'terminated' ? 'selected' : '' }}>Dihentikan</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai *</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('start_date') border-red-300 @enderror" 
                            required>
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai *</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('end_date') border-red-300 @enderror" 
                            required>
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-8">
                    <label for="project_assigned" class="block text-sm font-medium text-gray-700">Proyek yang Ditugaskan</label>
                    <input type="text" name="project_assigned" id="project_assigned" value="{{ old('project_assigned') }}" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Emergency Contact -->
            <div>
                <div class="border-b border-gray-200 pb-5 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900">Kontak Darurat</h3>
                    <p class="mt-2 text-sm text-gray-600">Informasi kontak dalam keadaan darurat</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="emergency_contact" class="block text-sm font-medium text-gray-700">Nama Kontak Darurat</label>
                        <input type="text" name="emergency_contact" id="emergency_contact" value="{{ old('emergency_contact') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="emergency_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon Darurat</label>
                        <input type="text" name="emergency_phone" id="emergency_phone" value="{{ old('emergency_phone') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <!-- Additional Information -->
            <div>
                <div class="border-b border-gray-200 pb-5 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Tambahan</h3>
                    <p class="mt-2 text-sm text-gray-600">Data pelengkap untuk evaluasi</p>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="completion_percentage" class="block text-sm font-medium text-gray-700">Persentase Penyelesaian (%)</label>
                        <input type="number" name="completion_percentage" id="completion_percentage" min="0" max="100" value="{{ old('completion_percentage', 0) }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="satisfaction_score" class="block text-sm font-medium text-gray-700">Skor Kepuasan (1-5)</label>
                        <select name="satisfaction_score" id="satisfaction_score" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Skor</option>
                            <option value="1" {{ old('satisfaction_score') == '1' ? 'selected' : '' }}>1 - Sangat Tidak Puas</option>
                            <option value="2" {{ old('satisfaction_score') == '2' ? 'selected' : '' }}>2 - Tidak Puas</option>
                            <option value="3" {{ old('satisfaction_score') == '3' ? 'selected' : '' }}>3 - Cukup Puas</option>
                            <option value="4" {{ old('satisfaction_score') == '4' ? 'selected' : '' }}>4 - Puas</option>
                            <option value="5" {{ old('satisfaction_score') == '5' ? 'selected' : '' }}>5 - Sangat Puas</option>
                        </select>
                    </div>
                </div>
                <div class="mt-8">
                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                    <textarea name="notes" id="notes" rows="4" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('notes') }}</textarea>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="flex items-center justify-end space-x-4 pt-8 mt-8 border-t border-gray-200">
                <a href="{{ route('interns.index') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Simpan Peserta Magang
                </button>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection