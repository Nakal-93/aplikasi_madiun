<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Admin Login - Kabupaten Madiun</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        /* Mobile specific adjustments */
        @media (max-width: 640px) {
            .mobile-padding { padding: 1rem; }
            .mobile-text { font-size: 0.875rem; }
            .mobile-logo { width: 4rem; height: 4rem; }
        }
    </style>
</head>

<body class="min-h-screen gradient-bg">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute -top-40 -right-32 w-80 h-80 rounded-full bg-white/10 blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-32 w-80 h-80 rounded-full bg-white/10 blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/3 left-1/4 w-60 h-60 rounded-full bg-white/5 blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <!-- Main Container -->
    <div class="relative min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-md space-y-8">
            
            <!-- Logo Section -->
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 glass-effect rounded-3xl mb-4 sm:mb-6 shadow-2xl">
                    <svg class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2">
                    Admin Dashboard
                </h1>
                <p class="text-white/80 text-base sm:text-lg">
                    Kabupaten Madiun
                </p>
            </div>

            <!-- Login Form -->
            <div class="glass-effect rounded-3xl p-6 sm:p-8 shadow-2xl backdrop-blur-xl">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-4 sm:mb-6 bg-red-500/20 border border-red-400/30 rounded-2xl p-3 sm:p-4 backdrop-blur-sm">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-300 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="text-sm font-medium text-red-200 mb-1">Login Gagal</h3>
                                <ul class="text-sm text-red-300 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Success Message -->
                @if (session('status'))
                    <div class="mb-4 sm:mb-6 bg-green-500/20 border border-green-400/30 rounded-2xl p-3 sm:p-4 backdrop-blur-sm">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm font-medium text-green-200">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-6" id="loginForm">
                    @csrf
                    
                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-white/90 mb-2 sm:mb-3">
                            Email Administrator
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white/60 group-focus-within:text-blue-300 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input 
                                id="email" 
                                name="email" 
                                type="email" 
                                autocomplete="email" 
                                required 
                                value="{{ old('email') }}"
                                placeholder="admin@madiunkab.go.id"
                                class="w-full pl-10 sm:pl-12 pr-3 sm:pr-4 py-3 sm:py-4 glass-effect border border-white/20 rounded-xl sm:rounded-2xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:border-blue-400/50 transition-all duration-300 text-sm sm:text-base @error('email') border-red-400/50 @enderror"
                            >
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-white/90 mb-2 sm:mb-3">
                            Password
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white/60 group-focus-within:text-blue-300 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                autocomplete="current-password" 
                                required
                                placeholder="Masukkan password"
                                class="w-full pl-10 sm:pl-12 pr-3 sm:pr-4 py-3 sm:py-4 glass-effect border border-white/20 rounded-xl sm:rounded-2xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:border-blue-400/50 transition-all duration-300 text-sm sm:text-base @error('password') border-red-400/50 @enderror"
                            >
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-300">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input 
                                id="remember" 
                                name="remember" 
                                type="checkbox" 
                                {{ old('remember') ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-500 focus:ring-blue-400 border-white/30 rounded bg-white/10 backdrop-blur-sm"
                            >
                            <span class="ml-2 sm:ml-3 text-sm text-white/90">Ingat saya</span>
                        </label>
                        
                        <a href="#" class="text-sm text-white/70 hover:text-white transition-colors duration-200">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Login Button -->
                    <div>
                        <button 
                            type="submit" 
                            id="loginButton"
                            class="w-full flex justify-center items-center py-3 sm:py-4 px-4 sm:px-6 text-base sm:text-lg font-semibold rounded-xl sm:rounded-2xl text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-1 btn-hover"
                        >
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 sm:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <span id="buttonText">Masuk ke Dashboard</span>
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="relative my-6 sm:my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/20"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-3 sm:px-4 glass-effect text-white/80 rounded-full text-sm">Akses Publik</span>
                    </div>
                </div>

                <!-- Public Links -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <a href="{{ route('aplikasi.index') }}"
                       class="flex items-center justify-center py-2.5 sm:py-3 px-3 sm:px-4 glass-effect border border-white/20 rounded-xl sm:rounded-2xl text-sm font-medium text-white/90 hover:text-white hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2V7"></path>
                        </svg>
                        Beranda
                    </a>
                    
                    <a href="{{ route('aplikasi.create') }}"
                       class="flex items-center justify-center py-2.5 sm:py-3 px-3 sm:px-4 glass-effect border border-white/20 rounded-xl sm:rounded-2xl text-sm font-medium text-white/90 hover:text-white hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Daftar App
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form submission with loading state
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const button = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            
            form.addEventListener('submit', function(e) {
                button.disabled = true;
                button.classList.add('opacity-75');
                buttonText.innerHTML = `
                    <svg class="animate-spin w-4 h-4 sm:w-5 sm:h-5 text-white inline mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses...
                `;
            });

            // Auto-fill demo credentials on Ctrl+Shift+D
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.shiftKey && e.key === 'D') {
                    e.preventDefault();
                    document.getElementById('email').value = 'admin@madiunkab.go.id';
                    document.getElementById('password').value = 'admin123';
                    
                    // Show notification
                    const notification = document.createElement('div');
                    notification.className = 'fixed top-4 right-4 bg-green-500/90 text-white px-4 py-2 rounded-lg shadow-lg z-50 text-sm';
                    notification.textContent = 'Demo credentials filled!';
                    document.body.appendChild(notification);
                    
                    setTimeout(() => {
                        notification.remove();
                    }, 2000);
                }
            });
        });
    </script>
</body>
</html>
