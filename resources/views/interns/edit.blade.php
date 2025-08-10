@extends('layouts.pln-dashboard')

@section('title', 'Edit Peserta Magang')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">Edit Peserta Magang</h1>
            <p class="mt-2 text-sm text-gray-600">Ubah data peserta magang: <strong>{{ $intern->name }}</strong></p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('interns.show', $intern) }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="mt-8">
        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <form action="{{ route('interns.update', $intern) }}" method="POST" class="space-y-6 p-6">
                @csrf
                @method('PUT')
                
                <!-- Personal Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pribadi</h3>
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $intern->name) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror" 
                                required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $intern->email) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror" 
                                required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $intern->phone) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="student_id" class="block text-sm font-medium text-gray-700">NIM/NIS</label>
                            <input type="text" name="student_id" id="student_id" value="{{ old('student_id', $intern->student_id) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('student_id') border-red-500 @enderror" 
                                required>
                            @error('student_id')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="address" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="address" id="address" rows="3" 
                            class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('address', $intern->address) }}</textarea>
                    </div>
                </div>

                <!-- Academic Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Akademik</h3>
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div>
                            <label for="university_id" class="block text-sm font-medium text-gray-700">Universitas</label>
                            <select name="university_id" id="university_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('university_id') border-red-500 @enderror" 
                                required>
                                <option value="">Pilih Universitas</option>
                                @foreach($universities as $university)
                                    <option value="{{ $university->id }}" {{ old('university_id', $intern->university_id) == $university->id ? 'selected' : '' }}>
                                        {{ $university->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('university_id')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="major" class="block text-sm font-medium text-gray-700">Program Studi</label>
                            <input type="text" name="major" id="major" value="{{ old('major', $intern->major) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('major') border-red-500 @enderror" 
                                required>
                            @error('major')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Internship Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Magang</h3>
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                        <div>
                            <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
                            <select name="department_id" id="department_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('department_id') border-red-500 @enderror" 
                                required>
                                <option value="">Pilih Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ old('department_id', $intern->department_id) == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="division_id" class="block text-sm font-medium text-gray-700">Divisi</label>
                            <select name="division_id" id="division_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('division_id') border-red-500 @enderror" 
                                required>
                                <option value="">Pilih Divisi</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}" {{ old('division_id', $intern->division_id) == $division->id ? 'selected' : '' }}>
                                        {{ $division->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('division_id')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="supervisor" class="block text-sm font-medium text-gray-700">Pembimbing</label>
                            <input type="text" name="supervisor" id="supervisor" value="{{ old('supervisor', $intern->supervisor) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('status') border-red-500 @enderror" 
                                required>
                                <option value="pending" {{ old('status', $intern->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="active" {{ old('status', $intern->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="completed" {{ old('status', $intern->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="terminated" {{ old('status', $intern->status) == 'terminated' ? 'selected' : '' }}>Dihentikan</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $intern->start_date ? $intern->start_date->format('Y-m-d') : '') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('start_date') border-red-500 @enderror" 
                                required>
                            @error('start_date')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $intern->end_date ? $intern->end_date->format('Y-m-d') : '') }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('end_date') border-red-500 @enderror" 
                                required>
                            @error('end_date')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="project_assigned" class="block text-sm font-medium text-gray-700">Proyek yang Ditugaskan</label>
                        <input type="text" name="project_assigned" id="project_assigned" value="{{ old('project_assigned', $intern->project_assigned) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Kontak Darurat</h3>
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div>
                            <label for="emergency_contact" class="block text-sm font-medium text-gray-700">Nama Kontak Darurat</label>
                            <input type="text" name="emergency_contact" id="emergency_contact" value="{{ old('emergency_contact', $intern->emergency_contact) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="emergency_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon Darurat</label>
                            <input type="text" name="emergency_phone" id="emergency_phone" value="{{ old('emergency_phone', $intern->emergency_phone) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Tambahan</h3>
                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                        <div>
                            <label for="completion_percentage" class="block text-sm font-medium text-gray-700">Persentase Penyelesaian (%)</label>
                            <input type="number" name="completion_percentage" id="completion_percentage" min="0" max="100" value="{{ old('completion_percentage', $intern->completion_percentage ?? 0) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="satisfaction_score" class="block text-sm font-medium text-gray-700">Skor Kepuasan (1-5)</label>
                            <select name="satisfaction_score" id="satisfaction_score" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Skor</option>
                                <option value="1" {{ old('satisfaction_score', $intern->satisfaction_score) == '1' ? 'selected' : '' }}>1 - Sangat Tidak Puas</option>
                                <option value="2" {{ old('satisfaction_score', $intern->satisfaction_score) == '2' ? 'selected' : '' }}>2 - Tidak Puas</option>
                                <option value="3" {{ old('satisfaction_score', $intern->satisfaction_score) == '3' ? 'selected' : '' }}>3 - Cukup Puas</option>
                                <option value="4" {{ old('satisfaction_score', $intern->satisfaction_score) == '4' ? 'selected' : '' }}>4 - Puas</option>
                                <option value="5" {{ old('satisfaction_score', $intern->satisfaction_score) == '5' ? 'selected' : '' }}>5 - Sangat Puas</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                        <textarea name="notes" id="notes" rows="4" 
                            class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes', $intern->notes) }}</textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 flex justify-between">
                    <button type="button" onclick="deleteIntern()" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        Hapus
                    </button>
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('interns.show', $intern) }}" 
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </a>
                        <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>

            <!-- Hidden Delete Form -->
            <form id="deleteForm" action="{{ route('interns.destroy', $intern) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>

            <script>
            function deleteIntern() {
                if (confirm('Apakah Anda yakin ingin menghapus peserta magang ini?')) {
                    document.getElementById('deleteForm').submit();
                }
            }
            </script>
        </div>
    </div>
    </div>
</div>
@endsection