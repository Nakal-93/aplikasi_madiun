<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Admin Login - Kabupaten Madiun</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen gradient-bg overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0">
        <div class="absolute -top-40 -right-32 w-80 h-80 rounded-full bg-white/10 blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-40 -left-32 w-80 h-80 rounded-full bg-white/10 blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute top-1/3 left-1/4 w-60 h-60 rounded-full bg-white/5 blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/3 right-1/4 w-60 h-60 rounded-full bg-white/5 blur-3xl animate-pulse" style="animation-delay: 3s;"></div>
    </div>

    <!-- Main Container -->
    <div class="relative min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            
            <!-- Logo Section -->
            <div class="text-center mb-8" data-aos="fade-down">
                <div class="inline-flex items-center justify-center w-24 h-24 glass-effect rounded-3xl mb-6 shadow-2xl">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">
                    Admin Dashboard
                </h1>
                <p class="text-white/80 text-lg">
                    Kabupaten Madiun
                </p>
            </div>

            <!-- Login Form -->
            <div class="glass-effect rounded-3xl p-8 shadow-2xl backdrop-blur-xl" data-aos="fade-up" data-aos-delay="200">
                
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-500/20 border border-red-400/30 rounded-2xl p-4 backdrop-blur-sm" data-aos="shake">
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
                    <div class="mb-6 bg-green-500/20 border border-green-400/30 rounded-2xl p-4 backdrop-blur-sm" data-aos="fade-in">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-sm font-medium text-green-200">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginForm">
                    @csrf
                    
                    <!-- Email Field -->
                    <div data-aos="fade-right" data-aos-delay="300">
                        <label for="email" class="block text-sm font-medium text-white/90 mb-3">
                            Email Administrator
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-white/60 group-focus-within:text-blue-300 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                class="w-full pl-12 pr-4 py-4 glass-effect border border-white/20 rounded-2xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:border-blue-400/50 transition-all duration-300 @error('email') border-red-400/50 @enderror"
                            >
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-300" data-aos="fade-in">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div data-aos="fade-left" data-aos-delay="400">
                        <label for="password" class="block text-sm font-medium text-white/90 mb-3">
                            Password
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-white/60 group-focus-within:text-blue-300 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                class="w-full pl-12 pr-4 py-4 glass-effect border border-white/20 rounded-2xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:border-blue-400/50 transition-all duration-300 @error('password') border-red-400/50 @enderror"
                            >
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-300" data-aos="fade-in">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between" data-aos="fade-up" data-aos-delay="500">
                        <label class="flex items-center">
                            <input 
                                id="remember" 
                                name="remember" 
                                type="checkbox" 
                                {{ old('remember') ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-500 focus:ring-blue-400 border-white/30 rounded bg-white/10 backdrop-blur-sm"
                            >
                            <span class="ml-3 text-sm text-white/90">Ingat saya</span>
                        </label>
                        
                        <a href="#" class="text-sm text-white/70 hover:text-white transition-colors duration-200">
                            Lupa password?
                        </a>
                    </div>

                    <!-- Login Button -->
                    <div data-aos="zoom-in" data-aos-delay="600">
                        <button 
                            type="submit" 
                            id="loginButton"
                            class="w-full flex justify-center items-center py-4 px-6 text-lg font-semibold rounded-2xl text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-1 btn-hover"
                        >
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <span id="buttonText">Masuk ke Dashboard</span>
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="relative my-8" data-aos="fade-up" data-aos-delay="700">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/20"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="px-4 glass-effect text-white/80 rounded-full text-sm">Akses Publik</span>
                    </div>
                </div>

                <!-- Public Links -->
                <div class="grid grid-cols-2 gap-3" data-aos="fade-up" data-aos-delay="800">
                    <a href="{{ route('aplikasi.index') }}"
                       class="flex items-center justify-center py-3 px-4 glass-effect border border-white/20 rounded-2xl text-sm font-medium text-white/90 hover:text-white hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2V7"></path>
                        </svg>
                        Beranda
                    </a>
                    
                    <a href="{{ route('aplikasi.create') }}"
                       class="flex items-center justify-center py-3 px-4 glass-effect border border-white/20 rounded-2xl text-sm font-medium text-white/90 hover:text-white hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Daftar App
                    </a>
                </div>

                <!-- Demo Info -->
                <div class="mt-6 p-4 bg-blue-500/20 border border-blue-400/30 rounded-2xl backdrop-blur-sm" data-aos="fade-in" data-aos-delay="900">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-300 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h3 class="text-sm font-medium text-blue-200 mb-2">Demo Login</h3>
                            <div class="text-sm text-blue-100 space-y-1">
                                <div class="flex items-center">
                                    <span class="font-medium mr-2">Email:</span>
                                    <code class="bg-blue-400/20 px-2 py-1 rounded text-xs">admin@madiunkab.go.id</code>
                                </div>
                                <div class="flex items-center">
                                    <span class="font-medium mr-2">Password:</span>
                                    <code class="bg-blue-400/20 px-2 py-1 rounded text-xs">admin123</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const button = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            
            button.disabled = true;
            button.classList.add('opacity-75');
            buttonText.innerHTML = `
                <svg class="animate-spin w-5 h-5 text-white inline mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
                notification.className = 'fixed top-4 right-4 bg-green-500/90 text-white px-4 py-2 rounded-lg shadow-lg z-50';
                notification.textContent = 'Demo credentials filled!';
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    notification.remove();
                }, 2000);
            }
        });
    </script>
</body>
</html>
        </div>

        <!-- Login Form Container -->
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md" data-aos="fade-up" data-aos-delay="200">
            <div class="glass-effect rounded-3xl p-8 shadow-2xl backdrop-blur-lg">
                
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-500/20 border border-red-500/30 rounded-2xl p-4 backdrop-blur-sm" data-aos="shake">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-100">
                                    Terjadi kesalahan pada form login
                                </h3>
                                <div class="mt-2 text-sm text-red-200">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Success Message -->
                @if (session('status'))
                    <div class="mb-6 bg-green-500/20 border border-green-500/30 rounded-2xl p-4 backdrop-blur-sm" data-aos="fade-in">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-100">{{ session('status') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form class="space-y-6" method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    
                    <!-- Email Field -->
                    <div data-aos="fade-right" data-aos-delay="300">
                        <label for="email" class="block text-sm font-medium text-white/90 mb-2">
                            Email Administrator
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-all duration-300 group-focus-within:text-blue-300">
                                <svg class="h-5 w-5 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input id="email" 
                                   name="email" 
                                   type="email" 
                                   autocomplete="email" 
                                   required 
                                   value="{{ old('email') }}"
                                   placeholder="admin@madiunkab.go.id"
                                   class="appearance-none block w-full pl-12 pr-4 py-4 glass-effect border border-white/20 rounded-2xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:border-blue-400/50 transition-all duration-300 @error('email') border-red-400/50 focus:ring-red-400/50 focus:border-red-400/50 @enderror">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-300" data-aos="fade-in">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div data-aos="fade-left" data-aos-delay="400">
                        <label for="password" class="block text-sm font-medium text-white/90 mb-2">
                            Password
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-all duration-300 group-focus-within:text-blue-300">
                                <svg class="h-5 w-5 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input id="password" 
                                   name="password" 
                                   type="password" 
                                   autocomplete="current-password" 
                                   required
                                   placeholder="Masukkan password"
                                   class="appearance-none block w-full pl-12 pr-4 py-4 glass-effect border border-white/20 rounded-2xl text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-blue-400/50 focus:border-blue-400/50 transition-all duration-300 @error('password') border-red-400/50 focus:ring-red-400/50 focus:border-red-400/50 @enderror">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-300" data-aos="fade-in">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between" data-aos="fade-up" data-aos-delay="500">
                        <div class="flex items-center">
                            <input id="remember" 
                                   name="remember" 
                                   type="checkbox" 
                                   {{ old('remember') ? 'checked' : '' }}
                                   class="h-4 w-4 text-blue-500 focus:ring-blue-400 border-white/30 rounded bg-white/10 backdrop-blur-sm">
                            <label for="remember" class="ml-3 block text-sm text-white/90">
                                Ingat saya
                            </label>
                        </div>
                        
                        <div class="text-sm">
                            <span class="text-white/70 hover:text-white cursor-pointer transition-colors">Lupa password?</span>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <div data-aos="zoom-in" data-aos-delay="600">
                        <button type="submit" 
                                id="loginButton"
                                class="group relative w-full flex justify-center py-4 px-6 border border-transparent text-lg font-semibold rounded-2xl text-white bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-2xl hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-1 btn-hover">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-4">
                                <svg class="h-6 w-6 text-blue-200 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                            </span>
                            <span id="buttonText">Masuk ke Dashboard</span>
                        </button>
                    </div>
                </form>

                <!-- Footer Links -->
                <div class="mt-8" data-aos="fade-up" data-aos-delay="700">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-white/20" />
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 glass-effect text-white/80 rounded-full">Akses Publik</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <a href="{{ route('aplikasi.index') }}"
                           class="w-full inline-flex justify-center items-center py-3 px-4 glass-effect border border-white/20 rounded-2xl text-sm font-medium text-white/90 hover:text-white hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2V7"></path>
                            </svg>
                            Halaman Utama
                        </a>
                        
                        <a href="{{ route('aplikasi.create') }}"
                           class="w-full inline-flex justify-center items-center py-3 px-4 glass-effect border border-white/20 rounded-2xl text-sm font-medium text-white/90 hover:text-white hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Daftar Aplikasi
                        </a>
                    </div>
                </div>

                <!-- Demo Credentials Info -->
                <div class="mt-6 glass-effect border border-blue-400/30 rounded-2xl p-4" data-aos="fade-in" data-aos-delay="800">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-200">
                                Demo Login
                            </h3>
                            <div class="mt-2 text-sm text-blue-100 space-y-1">
                                <p><strong>Email:</strong> admin@madiunkab.go.id</p>
                                <p><strong>Password:</strong> admin123</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const button = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');
            
            button.disabled = true;
            button.classList.add('opacity-75');
            buttonText.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            `;
        });

        // Auto-fill demo credentials
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab' && e.shiftKey && e.ctrlKey) {
                e.preventDefault();
                document.getElementById('email').value = 'admin@madiunkab.go.id';
                document.getElementById('password').value = 'admin123';
            }
        });
    </script>
</body>
</html>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Administrator
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                        <input id="email" 
                               name="email" 
                               type="email" 
                               autocomplete="email" 
                               required 
                               value="{{ old('email') }}"
                               placeholder="admin@madiunkab.go.id"
                               class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('email') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <input id="password" 
                               name="password" 
                               type="password" 
                               autocomplete="current-password" 
                               required
                               placeholder="Masukkan password"
                               class="appearance-none block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('password') border-red-300 focus:ring-red-500 focus:border-red-500 @enderror">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" 
                               name="remember" 
                               type="checkbox" 
                               {{ old('remember') ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Ingat saya
                        </label>
                    </div>
                    
                    <div class="text-sm">
                        <span class="text-gray-500">Lupa password?</span>
                    </div>
                </div>

                <!-- Login Button -->
                <div>
                    <button type="submit" 
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-blue-300 group-hover:text-blue-200 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                        </span>
                        Masuk ke Dashboard
                    </button>
                </div>
            </form>

            <!-- Footer Links -->
            <div class="mt-8">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300" />
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Akses Publik</span>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-3">
                    <a href="{{ route('aplikasi.index') }}"
                       class="w-full inline-flex justify-center items-center py-2 px-4 border border-gray-300 rounded-xl shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2V7"></path>
                        </svg>
                        Halaman Utama
                    </a>
                    
                    <a href="{{ route('aplikasi.create') }}"
                       class="w-full inline-flex justify-center items-center py-2 px-4 border border-gray-300 rounded-xl shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Daftar Aplikasi
                    </a>
                </div>
            </div>

            <!-- Demo Credentials Info -->
            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">
                            Demo Login
                        </h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <p><strong>Email:</strong> admin@madiunkab.go.id</p>
                            <p><strong>Password:</strong> admin123</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
