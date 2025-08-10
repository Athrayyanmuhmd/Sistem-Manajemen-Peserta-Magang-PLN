@extends('layouts.pln-dashboard')

@section('title', 'Tambah Divisi PLN')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Simple Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Divisi PLN</h1>
                <p class="mt-1 text-sm text-gray-600">Buat divisi atau unit kerja baru untuk PLN UID Aceh</p>
            </div>
            <a href="{{ route('divisions.index') }}" class="btn-secondary">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="bg-white shadow rounded-lg border border-gray-200">
        <form action="{{ route('divisions.store') }}" method="POST" class="p-6 space-y-8">
            @csrf
            
            <!-- Basic Information -->
            <div>
                <div class="border-b border-gray-200 pb-5 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Dasar</h3>
                    <p class="mt-2 text-sm text-gray-600">Data dasar divisi atau unit kerja</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Divisi *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror" 
                            placeholder="contoh: Teknologi Informasi"
                            required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="code" class="block text-sm font-medium text-gray-700">Kode Divisi *</label>
                        <input type="text" name="code" id="code" value="{{ old('code') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('code') border-red-300 @enderror" 
                            placeholder="contoh: TI"
                            maxlength="10"
                            required>
                        @error('code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700">Kapasitas Peserta *</label>
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity', 10) }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('capacity') border-red-300 @enderror" 
                            min="1"
                            required>
                        @error('capacity')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="head" class="block text-sm font-medium text-gray-700">Kepala Divisi</label>
                        <input type="text" name="head" id="head" value="{{ old('head') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nama kepala divisi">
                    </div>
                </div>
                <div class="mt-8">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Deskripsi singkat tentang divisi ini...">{{ old('description') }}</textarea>
                </div>
            </div>

            <!-- Contact Information -->
            <div>
                <div class="border-b border-gray-200 pb-5 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Kontak</h3>
                    <p class="mt-2 text-sm text-gray-600">Data kontak dan lokasi divisi</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('contact_email') border-red-300 @enderror"
                            placeholder="email@pln.co.id">
                        @error('contact_email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            placeholder="(0651) 123456">
                    </div>
                </div>
                <div class="mt-8">
                    <label for="location" class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                        placeholder="contoh: Gedung PLN Lantai 2, Banda Aceh">
                </div>
            </div>

            <!-- Status -->
            <div>
                <div class="border-b border-gray-200 pb-5 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900">Status Divisi</h3>
                    <p class="mt-2 text-sm text-gray-600">Pengaturan status operasional divisi</p>
                </div>
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input type="checkbox" name="is_active" id="is_active" value="1" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            {{ old('is_active', true) ? 'checked' : '' }}>
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="is_active" class="font-medium text-gray-700">Aktifkan Divisi</label>
                        <p class="text-gray-500">Divisi aktif dan dapat menerima peserta magang</p>
                    </div>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="flex items-center justify-end space-x-4 pt-8 mt-8 border-t border-gray-200">
                <a href="{{ route('divisions.index') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Simpan Divisi
                </button>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection