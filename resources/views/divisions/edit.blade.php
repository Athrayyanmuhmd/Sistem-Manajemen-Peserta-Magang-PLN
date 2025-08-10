@extends('layouts.pln-dashboard')

@section('title', 'Edit Divisi PLN')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">Edit Divisi PLN</h1>
            <p class="mt-2 text-sm text-gray-600">Ubah informasi divisi: <strong>{{ $division->name }}</strong></p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('divisions.show', $division) }}" class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="mt-8">
        <div class="bg-white shadow-sm rounded-lg border border-gray-200">
            <form action="{{ route('divisions.update', $division) }}" method="POST" class="space-y-6 p-6">
                @csrf
                @method('PUT')
                
                <!-- Basic Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Dasar</h3>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Divisi</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $division->name) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror" 
                                required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700">Kode Divisi</label>
                            <input type="text" name="code" id="code" value="{{ old('code', $division->code) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('code') border-red-500 @enderror" 
                                maxlength="10"
                                required>
                            @error('code')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="capacity" class="block text-sm font-medium text-gray-700">Kapasitas Peserta</label>
                            <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $division->capacity) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('capacity') border-red-500 @enderror" 
                                min="1"
                                required>
                            @error('capacity')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="head" class="block text-sm font-medium text-gray-700">Kepala Divisi</label>
                            <input type="text" name="head" id="head" value="{{ old('head', $division->head) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="3" 
                            class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $division->description) }}</textarea>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Kontak</h3>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="contact_email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $division->contact_email) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('contact_email') border-red-500 @enderror">
                            @error('contact_email')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="contact_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $division->contact_phone) }}" 
                                class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <input type="text" name="location" id="location" value="{{ old('location', $division->location) }}" 
                            class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Status</h3>
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 bg-white rounded"
                            {{ old('is_active', $division->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">
                            Divisi aktif dan dapat menerima peserta magang
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 flex justify-between">
                    @if($division->interns()->count() == 0)
                    <form action="{{ route('divisions.destroy', $division) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus divisi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                    @else
                    <div class="text-sm text-gray-500">
                        Divisi tidak dapat dihapus karena masih memiliki {{ $division->interns()->count() }} peserta magang
                    </div>
                    @endif
                    
                    <div class="flex space-x-3">
                        <a href="{{ route('divisions.show', $division) }}" 
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
        </div>
    </div>
    </div>
</div>
@endsection