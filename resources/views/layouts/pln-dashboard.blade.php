<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>PLN UID Aceh - @yield('title', 'Dashboard Magang')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Chart.js with Dark Theme -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/date-fns@2.29.3/index.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns@2.0.0/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
</head>

<body class="h-full bg-gray-50 antialiased">
    <div class="min-h-full">
        <!-- Mobile sidebar overlay -->
        <div id="mobile-sidebar-overlay" class="relative z-50 lg:hidden hidden" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-900/80" onclick="toggleMobileSidebar()"></div>
            <div class="fixed inset-0 flex">
                <div class="relative mr-16 flex w-full max-w-xs flex-1">
                    <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                        <button type="button" class="-m-2.5 p-2.5" onclick="toggleMobileSidebar()">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <!-- Mobile sidebar content (copy of desktop sidebar) -->
                    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-4 shadow-2xl">
                        <!-- Logo -->
                        <div class="flex h-16 shrink-0 items-center">
                            <div class="flex items-center space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 bg-white rounded-xl flex items-center justify-center shadow-lg p-2">
                                        <img src="{{ asset('assets/PLN-LOGO.png') }}" alt="PLN Logo" class="w-full h-full object-contain">
                                    </div>
                                </div>
                                <div>
                                    <h1 class="text-white text-lg font-bold">PLN UID Aceh</h1>
                                    <p class="text-gray-300 text-xs font-medium">Sistem Manajemen Magang</p>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Navigation -->
                        <nav class="flex flex-1 flex-col">
                            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                                <li>
                                    <div class="text-xs font-semibold leading-6 text-gray-400 mb-3">MENU UTAMA</div>
                                    <ul role="list" class="-mx-2 space-y-1">
                                        <li>
                                            <a href="{{ route('pln.dashboard') }}" class="group flex gap-x-3 rounded-lg px-3 py-2 text-sm font-medium leading-6 transition-all duration-200 @if(request()->routeIs('pln.dashboard')) bg-blue-600 text-white shadow-lg @else text-gray-300 hover:bg-gray-800 hover:text-white @endif">
                                                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                                </svg>
                                                Dashboard
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="text-xs font-semibold leading-6 text-gray-400 mb-3">MANAJEMEN DATA</div>
                                    <ul role="list" class="-mx-2 space-y-1">
                                        <li>
                                            <a href="{{ route('interns.index') }}" class="group flex gap-x-3 rounded-lg px-3 py-2 text-sm font-medium leading-6 transition-all duration-200 @if(request()->routeIs('interns.*')) bg-blue-600 text-white shadow-lg @else text-gray-300 hover:bg-gray-800 hover:text-white @endif">
                                                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                Peserta Magang
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('divisions.index') }}" class="group flex gap-x-3 rounded-lg px-3 py-2 text-sm font-medium leading-6 transition-all duration-200 @if(request()->routeIs('divisions.*')) bg-blue-600 text-white shadow-lg @else text-gray-300 hover:bg-gray-800 hover:text-white @endif">
                                                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                                Divisi PLN
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('universities.index') }}" class="group flex gap-x-3 rounded-lg px-3 py-2 text-sm font-medium leading-6 transition-all duration-200 @if(request()->routeIs('universities.*')) bg-blue-600 text-white shadow-lg @else text-gray-300 hover:bg-gray-800 hover:text-white @endif">
                                                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                                </svg>
                                                Universitas Partner
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="text-xs font-semibold leading-6 text-gray-400 mb-3">LAPORAN & ANALISIS</div>
                                    <ul role="list" class="-mx-2 space-y-1">
                                        <li>
                                            <a href="{{ route('analytics.index') }}" class="group flex gap-x-3 rounded-lg px-3 py-2 text-sm font-medium leading-6 transition-all duration-200 @if(request()->routeIs('analytics.index')) bg-blue-600 text-white shadow-lg @else text-gray-300 hover:bg-gray-800 hover:text-white @endif">
                                                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                </svg>
                                                Analytics Dashboard
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Desktop Sidebar -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-4 shadow-2xl">
                <!-- Logo -->
                <div class="flex h-16 shrink-0 items-center">
                    <div class="flex items-center space-x-3">
                        <div class="flex-shrink-0">
                            <div class="h-12 w-12 bg-white rounded-xl flex items-center justify-center shadow-lg p-2">
                                <img src="{{ asset('assets/PLN-LOGO.png') }}" alt="PLN Logo" class="w-full h-full object-contain">
                            </div>
                        </div>
                        <div>
                            <h1 class="text-white text-lg font-bold">PLN UID Aceh</h1>
                            <p class="text-gray-300 text-xs font-medium">Sistem Manajemen Magang</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <div class="text-xs font-semibold leading-6 text-gray-400 mb-3">MENU UTAMA</div>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <a href="{{ route('pln.dashboard') }}" class="group flex gap-x-3 rounded-lg px-3 py-2 text-sm font-medium leading-6 transition-all duration-200 @if(request()->routeIs('pln.dashboard')) bg-blue-600 text-white shadow-lg @else text-gray-300 hover:bg-gray-800 hover:text-white @endif">
                                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="text-xs font-semibold leading-6 text-gray-400 mb-3">MANAJEMEN DATA</div>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <a href="{{ route('interns.index') }}" class="group flex gap-x-3 rounded-lg px-3 py-2 text-sm font-medium leading-6 transition-all duration-200 @if(request()->routeIs('interns.*')) bg-blue-600 text-white shadow-lg @else text-gray-300 hover:bg-gray-800 hover:text-white @endif">
                                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        Peserta Magang
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('divisions.index') }}" class="group flex gap-x-3 rounded-lg px-3 py-2 text-sm font-medium leading-6 transition-all duration-200 @if(request()->routeIs('divisions.*')) bg-blue-600 text-white shadow-lg @else text-gray-300 hover:bg-gray-800 hover:text-white @endif">
                                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Divisi PLN
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('universities.index') }}" class="group flex gap-x-3 rounded-lg px-3 py-2 text-sm font-medium leading-6 transition-all duration-200 @if(request()->routeIs('universities.*')) bg-blue-600 text-white shadow-lg @else text-gray-300 hover:bg-gray-800 hover:text-white @endif">
                                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                        </svg>
                                        Universitas Partner
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div class="text-xs font-semibold leading-6 text-gray-400 mb-3">LAPORAN & ANALISIS</div>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <a href="{{ route('analytics.index') }}" class="group flex gap-x-3 rounded-lg px-3 py-2 text-sm font-medium leading-6 transition-all duration-200 @if(request()->routeIs('analytics.index')) bg-blue-600 text-white shadow-lg @else text-gray-300 hover:bg-gray-800 hover:text-white @endif">
                                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                        Analytics Dashboard
                                    </a>
                                </li>
                                <li>
                                    <div class="group">
                                        <button type="button" class="flex w-full gap-x-3 rounded-lg px-3 py-2 text-left text-sm font-medium leading-6 text-gray-300 hover:bg-gray-800 hover:text-white transition-all duration-200" onclick="toggleSubmenu('reports')">
                                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            Laporan
                                            <svg class="ml-auto h-4 w-4 shrink-0 transition-transform duration-200" id="reports-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                        <ul class="mt-1 hidden space-y-1" id="reports-submenu">
                                            <li><a href="#" class="group flex gap-x-3 rounded-lg px-8 py-2 text-sm font-medium leading-6 text-gray-400 hover:bg-gray-800 hover:text-white transition-all duration-200">Laporan Harian</a></li>
                                            <li><a href="#" class="group flex gap-x-3 rounded-lg px-8 py-2 text-sm font-medium leading-6 text-gray-400 hover:bg-gray-800 hover:text-white transition-all duration-200">Laporan Bulanan</a></li>
                                            <li><a href="#" class="group flex gap-x-3 rounded-lg px-8 py-2 text-sm font-medium leading-6 text-gray-400 hover:bg-gray-800 hover:text-white transition-all duration-200">Evaluasi Peserta</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        
                        <!-- Quick Stats Sidebar -->
                        <li class="mt-auto">
                            <div class="bg-gray-800 rounded-lg border border-gray-700 p-4 mb-4">
                                <h3 class="text-sm font-semibold text-white mb-3 flex items-center">
                                    <svg class="h-4 w-4 text-blue-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    Stats Ringkas
                                </h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-400 font-medium">Aktif Hari Ini</span>
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-emerald-400 rounded-full mr-2"></div>
                                            <span class="text-sm text-emerald-400 font-bold">23</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-400 font-medium">Selesai Minggu</span>
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-blue-400 rounded-full mr-2"></div>
                                            <span class="text-sm text-blue-400 font-bold">5</span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-xs text-gray-400 font-medium">Utilisasi</span>
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-amber-400 rounded-full mr-2"></div>
                                            <span class="text-sm text-amber-400 font-bold">78%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:pl-72">
            <!-- Top Header -->
            <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center border-b border-gray-200 bg-white px-4 shadow-sm sm:px-6 lg:px-8">
                <!-- Mobile menu button -->
                <button type="button" class="-m-2.5 p-2.5 text-gray-500 hover:text-gray-900 lg:hidden mr-4" onclick="toggleMobileSidebar()">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- Main content area -->
                <div class="flex flex-1 items-center justify-end">
                    <!-- Right: Clock, Notifications, Profile -->
                    <div class="flex items-center gap-x-3 ml-6">
                        <!-- Real-time Clock -->
                        <div class="hidden md:flex items-center">
                            <div class="bg-gray-50 rounded-lg px-4 py-2 border border-gray-200">
                                <div class="text-right">
                                    <div id="current-time" class="text-sm font-semibold text-gray-900 leading-tight"></div>
                                    <div id="current-date" class="text-xs text-gray-500 font-medium mt-0.5"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Notifications -->
                        <button type="button" class="relative p-2 text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                            <span class="sr-only">View notifications</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                            <span class="absolute -top-1 -right-1 h-2.5 w-2.5 bg-red-500 rounded-full border border-white"></span>
                        </button>

                        <!-- Separator -->
                        <div class="h-6 w-px bg-gray-200"></div>

                        <!-- Profile dropdown -->
                        <div class="relative">
                            <button type="button" class="flex items-center gap-x-2 p-1.5 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="h-8 w-8 rounded-lg bg-blue-600 flex items-center justify-center">
                                    <span class="text-white text-sm font-semibold">A</span>
                                </div>
                                <div class="hidden lg:flex items-center text-gray-900">
                                    <div class="text-left mr-2">
                                        <div class="text-sm font-semibold leading-tight">Admin PLN</div>
                                        <div class="text-xs text-gray-500">Administrator</div>
                                    </div>
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="py-8 bg-gray-50 min-h-screen">
                <div class="w-full mx-auto px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        function updateTime() {
            const now = new Date();
            const timeOptions = { 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit',
                hour12: false 
            };
            const dateOptions = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            };
            
            document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID', timeOptions) + ' WIB';
            document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', dateOptions);
        }
        
        function toggleSubmenu(id) {
            const submenu = document.getElementById(id + '-submenu');
            const icon = document.getElementById(id + '-icon');
            
            if (submenu.classList.contains('hidden')) {
                submenu.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                submenu.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        function toggleMobileSidebar() {
            const mobileOverlay = document.getElementById('mobile-sidebar-overlay');
            
            if (mobileOverlay.classList.contains('hidden')) {
                mobileOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                mobileOverlay.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }
        
        updateTime();
        setInterval(updateTime, 1000);
    </script>
</body>
</html>