<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ config('app.name') }} - @yield('title', 'Dashboard')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50 antialiased">
    <div class="min-h-full">
        <!-- Navigation -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 justify-between">
                    <!-- Logo and brand -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="flex items-center">
                                <div class="h-8 w-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">IM</span>
                                </div>
                                <span class="ml-3 text-xl font-semibold text-gray-900">Intern Manager</span>
                            </div>
                        </div>
                        
                        <!-- Desktop navigation -->
                        <div class="hidden md:ml-10 md:flex md:space-x-8">
                            <a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) border-blue-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium">
                                Dashboard
                            </a>
                            <a href="{{ route('interns.index') }}" class="@if(request()->routeIs('interns.*')) border-blue-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium">
                                Peserta Magang
                            </a>
                            <a href="{{ route('departments.index') }}" class="@if(request()->routeIs('departments.*')) border-blue-500 text-gray-900 @else border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 @endif inline-flex items-center border-b-2 px-1 pt-1 text-sm font-medium">
                                Departemen
                            </a>
                        </div>
                    </div>
                    
                    <!-- User menu -->
                    <div class="flex items-center">
                        <div class="relative ml-3">
                            <div class="flex items-center">
                                <button type="button" class="relative flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" id="user-menu-button">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center">
                                        <span class="text-white text-sm font-medium">A</span>
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Admin User</span>
                                    <svg class="ml-2 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div class="md:hidden">
                <div class="space-y-1 pb-3 pt-2">
                    <a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) bg-blue-50 border-blue-500 text-blue-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block border-l-4 py-2 pl-3 pr-4 text-base font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('interns.index') }}" class="@if(request()->routeIs('interns.*')) bg-blue-50 border-blue-500 text-blue-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block border-l-4 py-2 pl-3 pr-4 text-base font-medium">
                        Peserta Magang
                    </a>
                    <a href="{{ route('departments.index') }}" class="@if(request()->routeIs('departments.*')) bg-blue-50 border-blue-500 text-blue-700 @else border-transparent text-gray-500 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-700 @endif block border-l-4 py-2 pl-3 pr-4 text-base font-medium">
                        Departemen
                    </a>
                </div>
            </div>
        </nav>

        <!-- Page header -->
        @hasSection('header')
        <header class="bg-white shadow-sm">
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                @yield('header')
            </div>
        </header>
        @endif

        <!-- Main content -->
        <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <!-- Alert messages -->
            @if(session('success'))
            <div class="mb-6 rounded-md bg-green-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 rounded-md bg-red-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                © {{ date('Y') }} Intern Management System. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>