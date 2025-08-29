<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Berhasil - PLN</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('assets/PLN-LOGO.png') }}" alt="PLN Logo" class="h-10 w-auto">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-900">PT PLN (Persero)</h1>
                        <p class="text-sm text-gray-600">Program Magang</p>
                    </div>
                </div>
                <nav class="hidden md:flex space-x-4">
                    <a href="{{ route('intern.application.form') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 text-sm font-medium">Kembali ke Form</a>
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">Login Admin</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Success Content -->
    <div class="min-h-screen flex items-center justify-center py-12">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                <!-- Success Icon -->
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check-circle text-4xl text-green-600"></i>
                </div>

                <!-- Success Message -->
                <h1 class="text-2xl font-bold text-gray-900 mb-4">Pendaftaran Berhasil!</h1>
                
                <p class="text-gray-600 mb-8">
                    Terima kasih telah mendaftar program magang di PT PLN (Persero). 
                    Pendaftaran Anda telah berhasil dikirim dan sedang dalam proses review.
                </p>

                <!-- Info Cards -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-3"></i>
                        <div class="text-left">
                            <p class="text-sm font-medium text-blue-900">Langkah Selanjutnya</p>
                            <p class="text-sm text-blue-700">Tim HR kami akan menghubungi Anda melalui WhatsApp dalam 1-3 hari kerja.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-8">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mr-3"></i>
                        <div class="text-left">
                            <p class="text-sm font-medium text-yellow-900">Penting!</p>
                            <p class="text-sm text-yellow-700">Pastikan nomor WhatsApp Anda aktif dan dapat dihubungi.</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <a href="{{ route('intern.application.form') }}" 
                       class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition duration-200 inline-block">
                        <i class="fas fa-plus mr-2"></i>
                        Daftar Lagi
                    </a>
                    
                    <a href="https://www.pln.co.id" target="_blank"
                       class="w-full bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 transition duration-200 inline-block">
                        <i class="fas fa-globe mr-2"></i>
                        Kunjungi Website PLN
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <div class="flex items-center justify-center space-x-3 mb-4">
                    <img src="{{ asset('assets/PLN-LOGO.png') }}" alt="PLN Logo" class="h-8 w-auto">
                    <span class="text-lg font-semibold text-gray-900">PT PLN (Persero)</span>
                </div>
                <p class="text-gray-600">Program Magang - Membangun Masa Depan Energi Indonesia</p>
                <div class="mt-4 text-sm text-gray-500">
                    <p>&copy; {{ date('Y') }} PT PLN (Persero). All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>