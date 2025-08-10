@extends('layouts.pln-dashboard')

@section('title', 'Tambah Universitas Partner')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Simple Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tambah Universitas Partner</h1>
                <p class="mt-1 text-sm text-gray-600">Masukkan data lengkap universitas mitra program magang</p>
            </div>
            <a href="{{ route('universities.index') }}" class="btn-secondary">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Container -->
    <div class="bg-white shadow rounded-lg border border-gray-200">
        <form action="{{ route('universities.store') }}" method="POST" class="p-6 space-y-8">
            @csrf
                    
            <!-- Basic Information -->
            <div>
                <div class="border-b border-gray-200 pb-5 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Dasar</h3>
                    <p class="mt-2 text-sm text-gray-600">Data identitas dan informasi umum universitas</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap Universitas *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror" 
                            required placeholder="Contoh: Universitas Indonesia">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="short_name" class="block text-sm font-medium text-gray-700">Nama Singkat/Akronim</label>
                        <input type="text" name="short_name" id="short_name" value="{{ old('short_name') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Contoh: UI">
                    </div>

                    <div>
                        <label for="rector" class="block text-sm font-medium text-gray-700">Nama Rektor</label>
                        <input type="text" name="rector" id="rector" value="{{ old('rector') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Contoh: Prof. Dr. John Doe">
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">Kota *</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('city') border-red-300 @enderror" 
                            required placeholder="Contoh: Jakarta">
                        @error('city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="province" class="block text-sm font-medium text-gray-700">Provinsi *</label>
                        <input type="text" name="province" id="province" value="{{ old('province') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('province') border-red-300 @enderror" 
                            required placeholder="Contoh: DKI Jakarta">
                        @error('province')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mt-8">
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                    <textarea name="address" id="address" rows="3" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Masukkan alamat lengkap universitas">{{ old('address') }}</textarea>
                </div>
            </div>

            <!-- Contact Information -->
            <div>
                <div class="border-b border-gray-200 pb-5 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900">Informasi Kontak</h3>
                    <p class="mt-2 text-sm text-gray-600">Data kontak dan komunikasi universitas</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email Resmi</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-300 @enderror" 
                            placeholder="contoh@universitas.ac.id">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="+62 xxx xxxx xxxx">
                    </div>

                    <div class="md:col-span-2">
                        <label for="website" class="block text-sm font-medium text-gray-700">Website Resmi</label>
                        <input type="url" name="website" id="website" value="{{ old('website') }}" 
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('website') border-red-300 @enderror" 
                            placeholder="https://www.universitas.ac.id">
                        @error('website')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Section -->
            <div class="flex items-center justify-end space-x-4 pt-8 mt-8 border-t border-gray-200">
                <a href="{{ route('universities.index') }}" class="btn-secondary">
                    Batal
                </a>
                <button type="submit" class="btn-primary">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                    Simpan Universitas Partner
                </button>
            </div>
        </form>
    </div>
    </div>
</div>
@endsection