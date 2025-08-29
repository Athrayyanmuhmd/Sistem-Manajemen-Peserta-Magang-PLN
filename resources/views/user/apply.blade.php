<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Program Magang PLN - Wujudkan Karier di Dunia Kelistrikan</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        .nav-blur {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        
        .section {
            padding: 5rem 0;
        }
        
        @media (max-width: 768px) {
            .section {
                padding: 3rem 0;
            }
        }
        
        .card-minimal {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-minimal:hover {
            transform: translateY(-4px);
        }
        
        .text-shadow {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .container-custom {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        
        @media (min-width: 1024px) {
            .container-custom {
                padding: 0 2rem;
            }
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #64748b;
            border-radius: 3px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 bg-white/90 nav-blur border-b border-gray-200">
        <div class="container-custom">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <img src="assets/PLN-LOGO.png" alt="PLN Logo" class="h-10 w-auto">
                    <div>
                        <h1 class="text-lg font-semibold text-gray-900">PT PLN</h1>
                        <p class="text-xs text-gray-500 -mt-0.5">Program Magang</p>
                    </div>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="#beranda" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Beranda</a>
                    <a href="#tentang" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Tentang</a>
                    <a href="#divisi" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Divisi</a>
                    <a href="#galeri" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Galeri</a>
                    <a href="#daftar" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">Daftar</a>
                </div>
                
                <!-- CTA Button -->
                <div class="hidden lg:block">
                    <a href="#daftar" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-800 transition-colors">
                        Daftar Sekarang
                    </a>
                </div>
                
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden p-2 text-gray-600">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200">
            <div class="container-custom py-4 space-y-2">
                <a href="#beranda" class="block px-4 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">Beranda</a>
                <a href="#tentang" class="block px-4 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">Tentang</a>
                <a href="#divisi" class="block px-4 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">Divisi</a>
                <a href="#galeri" class="block px-4 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">Galeri</a>
                <a href="#daftar" class="block px-4 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-lg">Daftar</a>
                <div class="px-4 pt-2">
                    <a href="#daftar" class="block bg-gray-900 text-white px-4 py-3 rounded-lg text-sm font-medium text-center">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="pt-16 min-h-screen flex items-center bg-white">
        <div class="container-custom">
            <div class="grid lg:grid-cols-2 gap-16 items-center py-20">
                <!-- Content -->
                <div class="space-y-8 fade-in">
                    <div class="space-y-6">
                        <div class="inline-flex items-center px-3 py-1 bg-gray-100 rounded-full">
                            {{-- <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div> --}}
                            {{-- <span class="text-xs font-medium text-gray-700">Pendaftaran Dibuka</span> --}}
                        </div>
                        
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                            Bangun Karier di
                            <span class="text-blue-600">Dunia Kelistrikan</span>
                        </h1>
                        
                        <p class="text-lg text-gray-600 leading-relaxed max-w-lg">
                            Bergabunglah dengan program magang terdepan di PT PLN (Persero) dan dapatkan pengalaman berharga untuk masa depan energi Indonesia.
                        </p>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#daftar" class="inline-flex items-center justify-center bg-gray-900 text-white px-6 py-3 rounded-lg font-medium text-sm hover:bg-gray-800 transition-colors">
                            <i class="fas fa-arrow-right mr-2"></i>
                            Mulai Daftar
                        </a>
                        <a href="#tentang" class="inline-flex items-center justify-center border border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-medium text-sm hover:bg-gray-50 transition-colors">
                            <i class="fas fa-play mr-2"></i>
                            Pelajari Lebih
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 pt-8">
                        <div>
                            <div class="text-2xl font-bold text-gray-900 mb-1">1000+</div>
                            <div class="text-sm text-gray-500">Peserta Magang</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900 mb-1">15+</div>
                            <div class="text-sm text-gray-500">Divisi Tersedia</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-900 mb-1">95%</div>
                            <div class="text-sm text-gray-500">Tingkat Kepuasan</div>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Visual -->
                <div class="hidden lg:block fade-in" style="animation-delay: 0.2s;">
                    <div class="bg-gray-100 rounded-2xl p-8 space-y-6">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white p-6 rounded-xl shadow-sm">
                                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                                    <i class="fas fa-code text-blue-600"></i>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">Teknologi</h3>
                                <p class="text-sm text-gray-500">Modern & Inovatif</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl shadow-sm">
                                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                                    <i class="fas fa-users text-green-600"></i>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">Mentor</h3>
                                <p class="text-sm text-gray-500">Profesional Expert</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl shadow-sm">
                                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                                    <i class="fas fa-certificate text-purple-600"></i>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">Sertifikat</h3>
                                <p class="text-sm text-gray-500">Terakreditasi</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl shadow-sm">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                                    <i class="fas fa-chart-line text-orange-600"></i>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-1">Karier</h3>
                                <p class="text-sm text-gray-500">Berkembang Pesat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi Section -->
    <section id="tentang" class="section bg-gray-50">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <div class="inline-flex items-center px-3 py-1 bg-white rounded-full mb-6 shadow-sm">
                    <span class="text-xs font-medium text-gray-700">Tentang PLN</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Visi & Misi Perusahaan</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    PLN berkomitmen menjadi perusahaan listrik terkemuka se-Asia Tenggara dan berkelas dunia dengan bertumpu pada potensi insani.
                </p>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Visi -->
                <div class="card-minimal bg-white p-8 rounded-2xl shadow-sm fade-in">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-eye text-blue-600"></i>
                        </div>
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-gray-900">Visi</h3>
                            <p class="text-gray-600 leading-relaxed">
                                "Menjadi perusahaan listrik terkemuka se-Asia Tenggara dan berkelas dunia yang 
                                bertumbuh kembang, unggul dan terpercaya dengan bertumpu pada potensi insani."
                            </p>
                            <div class="space-y-2">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                    Kepemimpinan Regional Asia Tenggara
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                    Standar Kelas Dunia
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-check text-green-500 mr-2 text-xs"></i>
                                    Fokus Pengembangan SDM
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Misi -->
                <div class="card-minimal bg-white p-8 rounded-2xl shadow-sm fade-in" style="animation-delay: 0.1s;">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-target text-green-600"></i>
                        </div>
                        <div class="space-y-4">
                            <h3 class="text-xl font-bold text-gray-900">Misi</h3>
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <i class="fas fa-bolt text-blue-600 mr-3 mt-1 text-xs"></i>
                                    <p class="text-sm text-gray-600">Menjalankan bisnis kelistrikan dan bidang lain yang terkait</p>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-leaf text-green-600 mr-3 mt-1 text-xs"></i>
                                    <p class="text-sm text-gray-600">Menjadikan tenaga listrik sebagai media untuk meningkatkan kualitas kehidupan</p>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-handshake text-purple-600 mr-3 mt-1 text-xs"></i>
                                    <p class="text-sm text-gray-600">Mengupayakan tenaga listrik menjadi pendorong kegiatan ekonomi</p>
                                </div>
                                <div class="flex items-start">
                                    <i class="fas fa-globe text-orange-600 mr-3 mt-1 text-xs"></i>
                                    <p class="text-sm text-gray-600">Menjalankan kegiatan usaha yang berwawasan lingkungan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Divisions Section -->
    <section id="divisi" class="section bg-white">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <div class="inline-flex items-center px-3 py-1 bg-gray-100 rounded-full mb-6">
                    <span class="text-xs font-medium text-gray-700">Pilihan Divisi</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Divisi & Bidang Magang</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Pilih divisi yang sesuai dengan minat dan keahlian Anda. Setiap divisi menawarkan pengalaman pembelajaran yang berharga.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- IT Division -->
                <div class="card-minimal bg-gray-50 p-6 rounded-2xl fade-in">
                    <div class="space-y-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-code text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Teknologi Informasi</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                Pengembangan sistem informasi, infrastruktur IT, dan cybersecurity untuk mendukung operasional PLN.
                            </p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-xs text-gray-500">• Pengembangan Aplikasi</div>
                            <div class="text-xs text-gray-500">• Database Management</div>
                            <div class="text-xs text-gray-500">• Cyber Security</div>
                        </div>
                    </div>
                </div>

                <!-- Engineering Division -->
                <div class="card-minimal bg-gray-50 p-6 rounded-2xl fade-in" style="animation-delay: 0.1s;">
                    <div class="space-y-4">
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-cogs text-orange-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Engineering</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                Perancangan, pengembangan, dan pemeliharaan sistem kelistrikan dengan teknologi terdepan.
                            </p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-xs text-gray-500">• Electrical Design</div>
                            <div class="text-xs text-gray-500">• Power Systems</div>
                            <div class="text-xs text-gray-500">• Maintenance</div>
                        </div>
                    </div>
                </div>

                <!-- Operations Division -->
                <div class="card-minimal bg-gray-50 p-6 rounded-2xl fade-in" style="animation-delay: 0.2s;">
                    <div class="space-y-4">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-bolt text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Operasi</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                Pengelolaan operasional sistem tenaga listrik, monitoring jaringan, dan koordinasi distribusi.
                            </p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-xs text-gray-500">• Load Dispatch</div>
                            <div class="text-xs text-gray-500">• Grid Management</div>
                            <div class="text-xs text-gray-500">• Energy Trading</div>
                        </div>
                    </div>
                </div>

                <!-- Finance Division -->
                <div class="card-minimal bg-gray-50 p-6 rounded-2xl fade-in" style="animation-delay: 0.3s;">
                    <div class="space-y-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-chart-pie text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Keuangan</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                Pengelolaan keuangan perusahaan, analisis investasi, dan perencanaan anggaran strategis.
                            </p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-xs text-gray-500">• Financial Analysis</div>
                            <div class="text-xs text-gray-500">• Budget Planning</div>
                            <div class="text-xs text-gray-500">• Investment Strategy</div>
                        </div>
                    </div>
                </div>

                <!-- HR Division -->
                <div class="card-minimal bg-gray-50 p-6 rounded-2xl fade-in" style="animation-delay: 0.4s;">
                    <div class="space-y-4">
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-users text-red-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Sumber Daya Manusia</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                Pengembangan SDM, rekrutmen, pelatihan, dan manajemen talenta berkelanjutan.
                            </p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-xs text-gray-500">• Talent Management</div>
                            <div class="text-xs text-gray-500">• Training & Development</div>
                            <div class="text-xs text-gray-500">• Employee Relations</div>
                        </div>
                    </div>
                </div>

                <!-- Customer Service Division -->
                <div class="card-minimal bg-gray-50 p-6 rounded-2xl fade-in" style="animation-delay: 0.5s;">
                    <div class="space-y-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-headset text-indigo-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Pelayanan Pelanggan</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                Layanan prima untuk pelanggan, penanganan keluhan, dan customer relationship management.
                            </p>
                        </div>
                        <div class="space-y-2">
                            <div class="text-xs text-gray-500">• Customer Support</div>
                            <div class="text-xs text-gray-500">• Service Excellence</div>
                            <div class="text-xs text-gray-500">• CRM Systems</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="galeri" class="section bg-gray-50">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <div class="inline-flex items-center px-3 py-1 bg-white rounded-full mb-6 shadow-sm">
                    <span class="text-xs font-medium text-gray-700">Galeri Kegiatan</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Momen Program Magang</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Lihat aktivitas dan momen berharga dari kegiatan magang sebelumnya.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Gallery Items -->
                <div class="card-minimal bg-white rounded-2xl overflow-hidden shadow-sm fade-in">
                    <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                        <div class="text-center text-white">
                            <i class="fas fa-users text-3xl mb-3 opacity-80"></i>
                            <h4 class="font-semibold">Workshop Teknis</h4>
                            <p class="text-sm opacity-80">Pelatihan & Sertifikasi</p>
                        </div>
                    </div>
                </div>

                <div class="card-minimal bg-white rounded-2xl overflow-hidden shadow-sm fade-in" style="animation-delay: 0.1s;">
                    <div class="h-48 bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center">
                        <div class="text-center text-white">
                            <i class="fas fa-hard-hat text-3xl mb-3 opacity-80"></i>
                            <h4 class="font-semibold">Kunjungan Lapangan</h4>
                            <p class="text-sm opacity-80">Gardu & Pembangkit</p>
                        </div>
                    </div>
                </div>

                <div class="card-minimal bg-white rounded-2xl overflow-hidden shadow-sm fade-in" style="animation-delay: 0.2s;">
                    <div class="h-48 bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                        <div class="text-center text-white">
                            <i class="fas fa-laptop-code text-3xl mb-3 opacity-80"></i>
                            <h4 class="font-semibold">Proyek IT</h4>
                            <p class="text-sm opacity-80">Development & Innovation</p>
                        </div>
                    </div>
                </div>

                <div class="card-minimal bg-white rounded-2xl overflow-hidden shadow-sm fade-in" style="animation-delay: 0.3s;">
                    <div class="h-48 bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center">
                        <div class="text-center text-white">
                            <i class="fas fa-certificate text-3xl mb-3 opacity-80"></i>
                            <h4 class="font-semibold">Graduation Day</h4>
                            <p class="text-sm opacity-80">Penyerahan Sertifikat</p>
                        </div>
                    </div>
                </div>

                <div class="card-minimal bg-white rounded-2xl overflow-hidden shadow-sm fade-in" style="animation-delay: 0.4s;">
                    <div class="h-48 bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center">
                        <div class="text-center text-white">
                            <i class="fas fa-handshake text-3xl mb-3 opacity-80"></i>
                            <h4 class="font-semibold">Team Building</h4>
                            <p class="text-sm opacity-80">Kolaborasi & Networking</p>
                        </div>
                    </div>
                </div>

                <div class="card-minimal bg-white rounded-2xl overflow-hidden shadow-sm fade-in" style="animation-delay: 0.5s;">
                    <div class="h-48 bg-gradient-to-br from-teal-500 to-teal-600 flex items-center justify-center">
                        <div class="text-center text-white">
                            <i class="fas fa-presentation text-3xl mb-3 opacity-80"></i>
                            <h4 class="font-semibold">Final Presentation</h4>
                            <p class="text-sm opacity-80">Showcasing Results</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Form Section -->
    <section id="daftar" class="section bg-white">
        <div class="container-custom">
            <div class="text-center mb-16 fade-in">
                <div class="inline-flex items-center px-4 py-2 bg-gray-100 rounded-full mb-6">
                    <div class="w-2 h-2 bg-blue-600 rounded-full mr-2"></div>
                    <span class="text-sm font-medium text-gray-700">Pendaftaran Magang</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Formulir Pendaftaran</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Isi data diri Anda dengan lengkap dan benar. Pastikan semua informasi sudah sesuai sebelum mengirim.
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-white border border-gray-200 rounded-3xl shadow-sm overflow-hidden fade-in">
                    <!-- Form Header -->
                    <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                                <i class="fas fa-file-alt text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Program Magang PLN 2025</h3>
                                <p class="text-sm text-gray-500">Lengkapi semua field yang diperlukan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Display Errors -->
                    @if ($errors->any())
                        <div class="mx-8 mt-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex">
                                <i class="fas fa-exclamation-circle text-red-600 mt-0.5 mr-3"></i>
                                <div class="flex-1">
                                    <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Display Success -->
                    @if (session('success'))
                        <div class="mx-8 mt-6 bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex">
                                <i class="fas fa-check-circle text-green-600 mt-0.5 mr-3"></i>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form id="internship-form" action="{{ route('intern.application.store') }}" method="POST" class="p-8 lg:p-10">
                        @csrf
                        <div class="space-y-10">
                            <!-- Step 1: Personal Information -->
                            <div class="form-step space-y-6">
                                <div class="flex items-center space-x-3 pb-4">
                                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">1</div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Data Pribadi</h3>
                                        <p class="text-sm text-gray-500">Informasi dasar tentang diri Anda</p>
                                    </div>
                                </div>
                                
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Lengkap <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                                                   class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-gray-900 placeholder-gray-400" 
                                                   placeholder="Contoh: Ahmad Rizki Pratama">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fas fa-user text-gray-400 text-sm"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">
                                            NIM <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="text" id="nim" name="nim" value="{{ old('nim') }}" required 
                                                   class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-gray-900 placeholder-gray-400" 
                                                   placeholder="Contoh: 2021110001">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fas fa-id-card text-gray-400 text-sm"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nomor WhatsApp <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="tel" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" required 
                                                   class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-gray-900 placeholder-gray-400" 
                                                   placeholder="Contoh: 08123456789">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fab fa-whatsapp text-gray-400 text-sm"></i>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Format: 08xxxxxxxxxx (tanpa +62)</p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nametag" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama untuk Name Tag <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="text" id="nametag" name="nametag" value="{{ old('nametag') }}" required 
                                                   class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-gray-900 placeholder-gray-400" 
                                                   placeholder="Contoh: Ahmad Rizki">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fas fa-tag text-gray-400 text-sm"></i>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Nama yang akan ditampilkan di name tag</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Academic Information -->
                            <div class="form-step space-y-6">
                                <div class="flex items-center space-x-3 pb-4">
                                    <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">2</div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Informasi Akademik</h3>
                                        <p class="text-sm text-gray-500">Data universitas dan program studi</p>
                                    </div>
                                </div>
                                
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label for="university" class="block text-sm font-medium text-gray-700 mb-2">
                                            Universitas <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <select id="university" name="university_id" required 
                                                    class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-gray-900 bg-white appearance-none">
                                                <option value="">Pilih Universitas</option>
                                                @foreach(\App\Models\University::where('is_active', true)->get() as $university)
                                                    <option value="{{ $university->id }}" {{ old('university_id') == $university->id ? 'selected' : '' }}>
                                                        {{ $university->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="major" class="block text-sm font-medium text-gray-700 mb-2">
                                            Program Studi <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="text" id="major" name="major" value="{{ old('major') }}" required 
                                                   class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-gray-900 placeholder-gray-400" 
                                                   placeholder="Contoh: Teknik Elektro">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fas fa-graduation-cap text-gray-400 text-sm"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group md:col-span-2">
                                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                            Status Mahasiswa <span class="text-red-500">*</span>
                                        </label>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                            <label class="relative flex items-center cursor-pointer">
                                                <input type="radio" name="status" value="aktif" required class="sr-only peer">
                                                <div class="w-full px-4 py-3 border border-gray-300 rounded-xl peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700 transition-all text-center text-sm font-medium">
                                                    Aktif
                                                </div>
                                            </label>
                                            <label class="relative flex items-center cursor-pointer">
                                                <input type="radio" name="status" value="cuti" required class="sr-only peer">
                                                <div class="w-full px-4 py-3 border border-gray-300 rounded-xl peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700 transition-all text-center text-sm font-medium">
                                                    Cuti
                                                </div>
                                            </label>
                                            <label class="relative flex items-center cursor-pointer">
                                                <input type="radio" name="status" value="alumni" required class="sr-only peer">
                                                <div class="w-full px-4 py-3 border border-gray-300 rounded-xl peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700 transition-all text-center text-sm font-medium">
                                                    Alumni
                                                </div>
                                            </label>
                                            <label class="relative flex items-center cursor-pointer">
                                                <input type="radio" name="status" value="lainnya" required class="sr-only peer">
                                                <div class="w-full px-4 py-3 border border-gray-300 rounded-xl peer-checked:border-green-500 peer-checked:bg-green-50 peer-checked:text-green-700 transition-all text-center text-sm font-medium">
                                                    Lainnya
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Internship Details -->
                            <div class="form-step space-y-6">
                                <div class="flex items-center space-x-3 pb-4">
                                    <div class="w-8 h-8 bg-purple-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">3</div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">Detail Program Magang</h3>
                                        <p class="text-sm text-gray-500">Periode dan bidang magang yang dipilih</p>
                                    </div>
                                </div>
                                
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="form-group">
                                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                                            Tanggal Mulai Magang <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required 
                                                   class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-gray-900">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fas fa-calendar text-gray-400 text-sm"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">
                                            Tanggal Akhir Magang <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" required 
                                                   class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-gray-900">
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fas fa-calendar text-gray-400 text-sm"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">
                                            Masa Magang <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <select id="duration" name="duration_months" required 
                                                    class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-gray-900 bg-white appearance-none">
                                                <option value="">Pilih Durasi</option>
                                                <option value="1">1 Bulan</option>
                                                <option value="2">2 Bulan</option>
                                                <option value="3">3 Bulan</option>
                                                <option value="4">4 Bulan</option>
                                                <option value="5">5 Bulan</option>
                                                <option value="6">6 Bulan</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="bidang" class="block text-sm font-medium text-gray-700 mb-2">
                                            Bidang/Divisi <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <select id="bidang" name="division_id" required 
                                                    class="w-full px-4 py-3.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all text-gray-900 bg-white appearance-none">
                                                <option value="">Pilih Bidang</option>
                                                @foreach(\App\Models\Division::where('is_active', true)->get() as $division)
                                                    <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                                        {{ $division->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Section -->
                            <div class="pt-6 border-t border-gray-200">
                                <div class="bg-gray-50 rounded-2xl p-6">
                                    <div class="flex items-start space-x-3 mb-4">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <p class="font-medium mb-1">Pastikan data yang Anda masukkan sudah benar</p>
                                            <p>Tim HR PLN akan menghubungi Anda melalui WhatsApp dalam 1-3 hari kerja setelah pendaftaran diterima.</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <button type="button" id="draft-btn" 
                                                class="flex-1 bg-gray-100 text-gray-700 px-6 py-3.5 rounded-xl font-medium hover:bg-gray-200 focus:ring-4 focus:ring-gray-200 transition-all border border-gray-300">
                                            <i class="fas fa-save mr-2"></i>
                                            Simpan Draft
                                        </button>
                                        <button type="submit" id="submit-btn"
                                                class="flex-1 bg-gray-900 text-white px-6 py-3.5 rounded-xl font-medium hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 transition-all shadow-sm">
                                            <i class="fas fa-paper-plane mr-2"></i>
                                            Kirim Pendaftaran
                                        </button>
                                    </div>
                                    
                                    <div class="text-center pt-3">
                                        <p class="text-xs text-gray-500 leading-relaxed">
                                            Dengan mengirim formulir ini, Anda menyetujui 
                                            <a href="#" class="text-blue-600 hover:text-blue-700 underline">syarat dan ketentuan</a> 
                                            program magang PLN
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Progress Indicator -->
                <div class="mt-8 flex justify-center">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">1</div>
                            <span class="ml-2 text-sm font-medium text-gray-700">Data Pribadi</span>
                        </div>
                        <div class="w-8 h-px bg-gray-300"></div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">2</div>
                            <span class="ml-2 text-sm font-medium text-gray-700">Akademik</span>
                        </div>
                        <div class="w-8 h-px bg-gray-300"></div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-600 text-white rounded-full flex items-center justify-center text-sm font-semibold">3</div>
                            <span class="ml-2 text-sm font-medium text-gray-700">Detail Magang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white section">
        <div class="container-custom">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- Company Info -->
                <div class="col-span-2 space-y-4">
                    <div class="flex items-center space-x-3">
                        <img src="D:\KKP\magang\resources\assets\PLN-LOGO.png" alt="PLN Logo" class="h-10 w-auto">
                        <div>
                            <h3 class="text-lg font-semibold">PT PLN (Persero)</h3>
                            <p class="text-sm text-gray-400">Program Magang 2025</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm max-w-md">
                        Bergabunglah dengan program magang terbaik di Indonesia dan wujudkan karier 
                        impian Anda di dunia kelistrikan bersama PLN.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div class="space-y-4">
                    <h4 class="font-semibold">Menu</h4>
                    <div class="space-y-2">
                        <a href="#beranda" class="block text-sm text-gray-400 hover:text-white transition-colors">Beranda</a>
                        <a href="#tentang" class="block text-sm text-gray-400 hover:text-white transition-colors">Tentang</a>
                        <a href="#divisi" class="block text-sm text-gray-400 hover:text-white transition-colors">Divisi</a>
                        <a href="#galeri" class="block text-sm text-gray-400 hover:text-white transition-colors">Galeri</a>
                        <a href="#daftar" class="block text-sm text-gray-400 hover:text-white transition-colors">Daftar</a>
                    </div>
                </div>
                
                <!-- Contact -->
                <div class="space-y-4">
                    <h4 class="font-semibold">Kontak</h4>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-phone text-gray-400 text-xs"></i>
                            <span class="text-sm text-gray-400">+62 21 2525 5555</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-envelope text-gray-400 text-xs"></i>
                            <span class="text-sm text-gray-400">magang@pln.co.id</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-map-marker-alt text-gray-400 text-xs"></i>
                            <span class="text-sm text-gray-400">Jakarta, Indonesia</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Bottom -->
            <div class="border-t border-gray-800 pt-6 text-center">
                <p class="text-sm text-gray-400">
                    &copy; 2025 PT PLN (Persero). All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking on links
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Form validation and enhancement
        const form = document.getElementById('internship-form');
        const submitBtn = document.getElementById('submit-btn');
        const draftBtn = document.getElementById('draft-btn');
        
        if (form) {
            // Real-time validation
            const inputs = form.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.addEventListener('blur', validateField);
                input.addEventListener('input', clearError);
            });
            
            // Date validation
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');
            const duration = document.getElementById('duration');
            
            if (startDate && endDate) {
                startDate.addEventListener('change', validateDates);
                endDate.addEventListener('change', validateDates);
                duration.addEventListener('change', calculateDates);
            }
            
            // Phone number formatting
            const whatsappInput = document.getElementById('whatsapp');
            if (whatsappInput) {
                whatsappInput.addEventListener('input', formatPhoneNumber);
            }
            
            // Form submission - let it submit normally to server
            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    showError('Mohon lengkapi semua field yang diperlukan dengan benar.');
                    return false;
                }
                
                // Show loading state
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
                submitBtn.disabled = true;
                
                // Let form submit normally
                return true;
            });
            
            // Draft saving
            if (draftBtn) {
                draftBtn.addEventListener('click', saveDraft);
            }
            
            // Load saved draft
            loadDraft();
        }
        
        function validateField(e) {
            const field = e.target;
            const value = field.value.trim();
            
            clearError(e);
            
            if (field.required && !value) {
                showFieldError(field, 'Field ini wajib diisi');
                return false;
            }
            
            // Specific validations
            switch (field.id) {
                case 'whatsapp':
                    if (value && !isValidPhoneNumber(value)) {
                        showFieldError(field, 'Format nomor WhatsApp tidak valid');
                        return false;
                    }
                    break;
                case 'nim':
                    if (value && value.length < 6) {
                        showFieldError(field, 'NIM minimal 6 karakter');
                        return false;
                    }
                    break;
                case 'name':
                    if (value && value.length < 3) {
                        showFieldError(field, 'Nama minimal 3 karakter');
                        return false;
                    }
                    break;
            }
            
            return true;
        }
        
        function clearError(e) {
            const field = e.target;
            const errorElement = field.parentNode.querySelector('.error-message');
            if (errorElement) {
                errorElement.remove();
            }
            field.classList.remove('border-red-500');
        }
        
        function showFieldError(field, message) {
            field.classList.add('border-red-500');
            
            const existingError = field.parentNode.querySelector('.error-message');
            if (existingError) {
                existingError.textContent = message;
                return;
            }
            
            const errorElement = document.createElement('p');
            errorElement.className = 'error-message text-red-500 text-xs mt-1';
            errorElement.textContent = message;
            field.parentNode.appendChild(errorElement);
        }
        
        function validateDates() {
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');
            
            if (startDate.value && endDate.value) {
                const start = new Date(startDate.value);
                const end = new Date(endDate.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                if (start < today) {
                    showFieldError(startDate, 'Tanggal mulai tidak boleh di masa lalu');
                    return false;
                }
                
                if (end <= start) {
                    showFieldError(endDate, 'Tanggal akhir harus setelah tanggal mulai');
                    return false;
                }
                
                // Calculate duration
                const diffTime = Math.abs(end - start);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                const months = Math.floor(diffDays / 30);
                
                const durationSelect = document.getElementById('duration');
                if (months > 0 && durationSelect.value !== months.toString()) {
                    durationSelect.value = months.toString();
                }
            }
            
            return true;
        }
        
        function calculateDates() {
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');
            const duration = document.getElementById('duration');
            
            if (startDate.value && duration.value && !endDate.value) {
                const start = new Date(startDate.value);
                const months = parseInt(duration.value);
                const end = new Date(start.getFullYear(), start.getMonth() + months, start.getDate());
                
                endDate.value = end.toISOString().split('T')[0];
            }
        }
        
        function formatPhoneNumber(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.startsWith('62')) {
                value = '0' + value.substring(2);
            }
            
            if (value.length > 13) {
                value = value.substring(0, 13);
            }
            
            e.target.value = value;
        }
        
        function isValidPhoneNumber(phone) {
            const phoneRegex = /^08[0-9]{8,11}$/;
            return phoneRegex.test(phone);
        }
        
        function validateForm() {
            const requiredFields = form.querySelectorAll('input[required], select[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!validateField({ target: field })) {
                    isValid = false;
                }
            });
            
            // Status mahasiswa radio buttons tidak wajib untuk form aplikasi
            
            return isValid;
        }
        
        function submitForm() {
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
            submitBtn.disabled = true;
            
            // Simulate form submission
            setTimeout(() => {
                // Reset button
                submitBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Terkirim!';
                submitBtn.classList.remove('bg-gray-900', 'hover:bg-gray-800');
                submitBtn.classList.add('bg-green-600', 'hover:bg-green-700');
                
                // Show success message
                showSuccess('Pendaftaran berhasil dikirim! Tim HR PLN akan menghubungi Anda dalam 1-3 hari kerja.');
                
                // Clear draft
                localStorage.removeItem('pln_internship_draft');
                
                // Reset form after delay
                setTimeout(() => {
                    form.reset();
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i>Kirim Pendaftaran';
                    submitBtn.classList.remove('bg-green-600', 'hover:bg-green-700');
                    submitBtn.classList.add('bg-gray-900', 'hover:bg-gray-800');
                    submitBtn.disabled = false;
                }, 3000);
            }, 2000);
        }
        
        function saveDraft() {
            const formData = new FormData(form);
            const draftData = {};
            
            for (let [key, value] of formData.entries()) {
                draftData[key] = value;
            }
            
            // Include radio button values
            const statusRadios = form.querySelectorAll('input[name="status"]');
            statusRadios.forEach(radio => {
                if (radio.checked) {
                    draftData.status = radio.value;
                }
            });
            
            localStorage.setItem('pln_internship_draft', JSON.stringify(draftData));
            
            // Show feedback
            const originalText = draftBtn.innerHTML;
            draftBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Tersimpan!';
            draftBtn.classList.add('bg-green-100', 'text-green-700');
            
            setTimeout(() => {
                draftBtn.innerHTML = originalText;
                draftBtn.classList.remove('bg-green-100', 'text-green-700');
            }, 2000);
        }
        
        function loadDraft() {
            const draftData = localStorage.getItem('pln_internship_draft');
            if (!draftData) return;
            
            try {
                const data = JSON.parse(draftData);
                
                Object.keys(data).forEach(key => {
                    if (key === 'status') {
                        const radio = form.querySelector(`input[name="status"][value="${data[key]}"]`);
                        if (radio) radio.checked = true;
                    } else {
                        const field = form.querySelector(`[name="${key}"]`);
                        if (field) field.value = data[key];
                    }
                });
                
                // Show notification
                showInfo('Draft tersimpan dimuat. Anda dapat melanjutkan pengisian formulir.');
            } catch (e) {
                localStorage.removeItem('pln_internship_draft');
            }
        }
        
        function showError(message) {
            showNotification(message, 'error');
        }
        
        function showSuccess(message) {
            showNotification(message, 'success');
        }
        
        function showInfo(message) {
            showNotification(message, 'info');
        }
        
        function showNotification(message, type) {
            // Remove existing notifications
            const existing = document.querySelectorAll('.notification');
            existing.forEach(el => el.remove());
            
            const notification = document.createElement('div');
            notification.className = `notification fixed top-4 right-4 z-50 max-w-sm p-4 rounded-lg shadow-lg border transform translate-x-full transition-transform duration-300`;
            
            const colors = {
                error: 'bg-red-50 border-red-200 text-red-800',
                success: 'bg-green-50 border-green-200 text-green-800',
                info: 'bg-blue-50 border-blue-200 text-blue-800'
            };
            
            const icons = {
                error: 'fas fa-exclamation-circle',
                success: 'fas fa-check-circle',
                info: 'fas fa-info-circle'
            };
            
            notification.classList.add(...colors[type].split(' '));
            notification.innerHTML = `
                <div class="flex items-start">
                    <i class="${icons[type]} mt-0.5 mr-3"></i>
                    <div class="flex-1">
                        <p class="text-sm font-medium">${message}</p>
                    </div>
                    <button onclick="this.parentNode.parentNode.remove()" class="ml-3 text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Auto remove
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        }

        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });

        // Add smooth navbar background on scroll
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('bg-white/95');
                nav.classList.remove('bg-white/90');
            } else {
                nav.classList.add('bg-white/90');
                nav.classList.remove('bg-white/95');
            }
        });

        // Show success popup if there's a session success message
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                // Create success popup
                const popup = document.createElement('div');
                popup.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center';
                popup.innerHTML = `
                    <div class="bg-white rounded-xl shadow-2xl p-8 max-w-md mx-4 transform scale-95 transition-transform duration-300">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-check-circle text-3xl text-green-600"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Pendaftaran Berhasil!</h3>
                            <p class="text-gray-600 mb-6">{{ session('success') }}</p>
                            <div class="flex gap-3">
                                <button onclick="this.closest('.fixed').remove()" 
                                        class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                                    Tutup
                                </button>
                                <a href="{{ route('intern.application.success') }}" 
                                   class="flex-1 bg-green-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-green-700 transition-colors text-center">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                document.body.appendChild(popup);
                
                // Animate in
                setTimeout(() => {
                    popup.querySelector('div > div').classList.remove('scale-95');
                    popup.querySelector('div > div').classList.add('scale-100');
                }, 100);
            });
        @endif
    </script>
</body>
</html>