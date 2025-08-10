<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - PLN Intern Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom Glassmorphism Styles */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .glass-strong {
            background: rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.25);
        }

        .animated-bg {
            background: linear-gradient(-45deg, #1e40af, #3b82f6, #60a5fa, #93c5fd);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translate(0, 0px); }
            50% { transform: translate(0, -10px); }
            100% { transform: translate(0, 0px); }
        }

        .glow {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }

        .input-glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .input-glass:focus {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
        }

        .btn-glass {
            background: rgba(59, 130, 246, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .btn-glass:hover {
            background: rgba(37, 99, 235, 0.9);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
        }

        .btn-dev {
            background: rgba(34, 197, 94, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .btn-dev:hover {
            background: rgba(21, 128, 61, 0.9);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(34, 197, 94, 0.4);
        }

        /* Particle Animation */
        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: particle-float 8s infinite linear;
        }

        @keyframes particle-float {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) scale(1);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="animated-bg min-h-screen overflow-hidden">
    <!-- Floating Particles -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="particle" style="left: 10%; width: 6px; height: 6px; animation-delay: 0s; animation-duration: 6s;"></div>
        <div class="particle" style="left: 20%; width: 4px; height: 4px; animation-delay: 2s; animation-duration: 8s;"></div>
        <div class="particle" style="left: 30%; width: 8px; height: 8px; animation-delay: 1s; animation-duration: 7s;"></div>
        <div class="particle" style="left: 40%; width: 5px; height: 5px; animation-delay: 3s; animation-duration: 9s;"></div>
        <div class="particle" style="left: 50%; width: 7px; height: 7px; animation-delay: 0.5s; animation-duration: 6s;"></div>
        <div class="particle" style="left: 60%; width: 4px; height: 4px; animation-delay: 2.5s; animation-duration: 8s;"></div>
        <div class="particle" style="left: 70%; width: 6px; height: 6px; animation-delay: 1.5s; animation-duration: 7s;"></div>
        <div class="particle" style="left: 80%; width: 5px; height: 5px; animation-delay: 3.5s; animation-duration: 9s;"></div>
        <div class="particle" style="left: 90%; width: 8px; height: 8px; animation-delay: 4s; animation-duration: 6s;"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative">
        <div class="max-w-md w-full space-y-8 z-10">
            <!-- Logo Section -->
            <div class="text-center floating">
                <div class="mx-auto h-24 w-24 glass-strong rounded-full flex items-center justify-center shadow-2xl glow mb-6">
                    <img src="{{ asset('assets/PLN-LOGO.png') }}" alt="PLN Logo" class="h-20 w-20 object-contain">
                </div>
                <h2 class="text-4xl font-bold text-white mb-2 drop-shadow-lg">
                    PLN Intern Management
                </h2>
                <p class="text-lg text-blue-100 font-light">
                    Sistem Manajemen Peserta Magang
                </p>
            </div>

            <!-- Login Form -->
            <div class="glass-strong rounded-3xl shadow-2xl p-8 space-y-6">
                @if($errors->any())
                    <div class="glass rounded-2xl p-4 border-l-4 border-red-400">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-100">
                                    {{ $errors->first() }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <form class="space-y-6" action="{{ route('login.post') }}" method="POST">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="group">
                        <label for="email" class="block text-sm font-semibold text-white mb-2">
                            📧 Alamat Email
                        </label>
                        <input 
                            id="email" 
                            name="email" 
                            type="email" 
                            autocomplete="email" 
                            required
                            value="{{ old('email') }}"
                            placeholder="Masukkan email Anda"
                            class="input-glass w-full px-4 py-3 rounded-2xl text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-300 @error('email') border-red-400 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="group">
                        <label for="password" class="block text-sm font-semibold text-white mb-2">
                            🔒 Kata Sandi
                        </label>
                        <input 
                            id="password" 
                            name="password" 
                            type="password" 
                            autocomplete="current-password" 
                            required
                            placeholder="Masukkan kata sandi"
                            class="input-glass w-full px-4 py-3 rounded-2xl text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-300 @error('password') border-red-400 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                id="remember" 
                                name="remember" 
                                type="checkbox"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded bg-transparent">
                            <label for="remember" class="ml-2 block text-sm text-blue-100">
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <div>
                        <button 
                            type="submit"
                            class="btn-glass w-full flex justify-center items-center py-3 px-4 rounded-2xl text-white font-semibold text-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                            </svg>
                            Masuk ke Sistem
                        </button>
                    </div>
                </form>

                <!-- Development Access -->
                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-blue-300 border-opacity-30"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-3 text-blue-200 glass rounded-full py-1">Mode Pengembangan</span>
                        </div>
                    </div>
                    <div class="mt-6">
                        <a 
                            href="{{ route('dev-login') }}"
                            class="btn-dev w-full flex justify-center items-center py-3 px-4 rounded-2xl text-white font-semibold focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                            Akses Cepat (Dev Only)
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center">
                <p class="text-blue-200 text-sm">
                    © 2025 PLN (Persero). Hak Cipta Dilindungi.
                </p>
                <p class="text-blue-300 text-xs mt-1">
                    Sistem Manajemen Peserta Magang v1.0
                </p>
            </div>
        </div>
    </div>

    <script>
        // Add interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus glow effect to inputs
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('scale-105');
                });
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('scale-105');
                });
            });

            // Add click animation to buttons
            const buttons = document.querySelectorAll('button, a[class*="btn-"]');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 150);
                });
            });

            // Create additional floating particles
            const createParticle = () => {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.width = particle.style.height = Math.random() * 10 + 3 + 'px';
                particle.style.animationDuration = Math.random() * 4 + 4 + 's';
                particle.style.animationDelay = Math.random() * 2 + 's';
                document.querySelector('.fixed').appendChild(particle);

                setTimeout(() => {
                    particle.remove();
                }, 8000);
            };

            // Generate particles periodically
            setInterval(createParticle, 2000);
        });
    </script>
</body>
</html>