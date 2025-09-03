<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title') - Data Aplikasi Kabupaten Madiun</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.5s ease-in forwards;
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
        
        [x-cloak] { display: none !important; }
        
        .dropdown-menu {
            display: none;
        }
        
        .dropdown-menu.show {
            display: block;
        }
        
        /* Sidebar animations */
        #mobileSidebar {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        #mobileOverlay {
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        }
        
        /* Hamburger icon animations */
        #hamburgerIcon, #closeIcon {
            transition: all 0.2s ease-in-out;
        }
        
        /* Smooth hover effects */
        .sidebar-link {
            transition: all 0.2s ease-in-out;
        }
        
        .sidebar-link:hover {
            transform: translateX(4px);
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-200 sticky top-0 z-50 backdrop-blur-sm bg-white/95">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Left side: Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="ml-3 hidden sm:block">
                            <h1 class="text-xl font-bold text-gray-900">Data Aplikasi</h1>
                            <p class="text-xs text-gray-500 -mt-1">Kabupaten Madiun</p>
                        </div>
                    </div>

                    <!-- Desktop Navigation -->
                    <div class="hidden lg:ml-8 lg:flex lg:space-x-1">
                        <a href="{{ route('aplikasi.index') }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('aplikasi.index') ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2V7"></path>
                            </svg>
                            Beranda
                        </a>
                        
                        <a href="{{ route('aplikasi.create') }}" 
                           class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('aplikasi.create') ? 'bg-green-100 text-green-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Aplikasi
                        </a>

                        @auth
                            <a href="{{ route('admin.dashboard') }}" 
                               class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 {{ request()->routeIs('admin.*') ? 'bg-purple-100 text-purple-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                Dashboard
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Right side: User menu & Hamburger -->
                <div class="flex items-center space-x-4">
                    @auth
                        <!-- Desktop User dropdown -->
                        <div class="hidden lg:block relative">
                            <button id="userMenuButton" 
                                    type="button"
                                    class="flex items-center space-x-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-300"
                                    aria-expanded="false"
                                    aria-haspopup="true">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <span class="hidden xl:block">{{ Auth::user()->name }}</span>
                                <svg id="userMenuChevron" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div id="userMenuDropdown" 
                                 class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50 opacity-0 scale-95 transition-all duration-200">
                                
                                <div class="px-4 py-2 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-600">{{ Auth::user()->email }}</p>
                                </div>

                                <a href="{{ route('admin.dashboard') }}" 
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Dashboard
                                </a>

                                <a href="{{ route('admin.aplikasi') }}" 
                                   class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Kelola Aplikasi
                                </a>

                                <hr class="my-2">

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" 
                           class="hidden lg:inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Login Admin
                        </a>
                    @endauth

                    <!-- Hamburger Menu Button (Mobile/Tablet) -->
                    <button id="hamburgerBtn" 
                            type="button"
                            class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-all duration-300 z-50 relative"
                            aria-controls="mobile-menu"
                            aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- Hamburger icon -->
                        <svg id="hamburgerIcon" class="block h-6 w-6 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- X icon -->
                        <svg id="closeIcon" class="hidden h-6 w-6 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Overlay -->
    <div id="mobileOverlay" 
         class="fixed inset-0 bg-gray-900 bg-opacity-50 z-40 lg:hidden opacity-0 invisible transition-all duration-300"></div>

    <!-- Mobile Sidebar -->
    <div id="mobileSidebar" 
         class="fixed top-0 left-0 h-full w-80 bg-white shadow-xl z-50 lg:hidden transform -translate-x-full transition-transform duration-300 ease-in-out">
        
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h1 class="text-lg font-bold text-gray-900">Data Aplikasi</h1>
                    <p class="text-xs text-gray-500 -mt-1">Kabupaten Madiun</p>
                </div>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <div class="flex-1 px-6 py-6 space-y-2">
            <a href="{{ route('aplikasi.index') }}" 
               class="sidebar-link flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('aplikasi.index') ? 'bg-blue-100 text-blue-700 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2V7"></path>
                </svg>
                Beranda
            </a>
            
            <a href="{{ route('aplikasi.create') }}" 
               class="sidebar-link flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('aplikasi.create') ? 'bg-green-100 text-green-700 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Aplikasi
            </a>

            @auth
                <a href="{{ route('admin.dashboard') }}" 
                   class="sidebar-link flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.*') ? 'bg-purple-100 text-purple-700 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Dashboard Admin
                </a>

                <a href="{{ route('admin.aplikasi') }}" 
                   class="sidebar-link flex items-center px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.aplikasi') ? 'bg-purple-100 text-purple-700 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Kelola Aplikasi
                </a>
            @endauth
        </div>

        <!-- Sidebar Footer -->
        <div class="border-t border-gray-200 p-6">
            @auth
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-600">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="sidebar-link flex items-center w-full px-4 py-3 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 transition-all duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" 
                   class="sidebar-link flex items-center w-full px-4 py-3 rounded-xl text-sm font-medium bg-blue-600 hover:bg-blue-700 text-white transition-all duration-200 shadow-lg">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Login Admin
                </a>
            @endauth
        </div>
    </div>

    <!-- Content -->
    <main class="flex-grow w-full py-6 px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-auto">
        <div class="w-full py-4 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-300 text-sm">
                    &copy; {{ date('Y') }} Muntaha Diskominfo Kabupaten Madiun.
                </p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Hamburger menu functionality
            const hamburgerBtn = document.getElementById('hamburgerBtn');
            const hamburgerIcon = document.getElementById('hamburgerIcon');
            const closeIcon = document.getElementById('closeIcon');
            const mobileSidebar = document.getElementById('mobileSidebar');
            const mobileOverlay = document.getElementById('mobileOverlay');
            
            let sidebarOpen = false;
            
            function toggleSidebar() {
                sidebarOpen = !sidebarOpen;
                
                if (sidebarOpen) {
                    // Open sidebar
                    mobileSidebar.classList.remove('-translate-x-full');
                    mobileSidebar.classList.add('translate-x-0');
                    
                    mobileOverlay.classList.remove('opacity-0', 'invisible');
                    mobileOverlay.classList.add('opacity-100', 'visible');
                    
                    // Toggle icons
                    hamburgerIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                    
                    // Prevent body scroll
                    document.body.style.overflow = 'hidden';
                    
                    hamburgerBtn.setAttribute('aria-expanded', 'true');
                } else {
                    closeSidebar();
                }
            }
            
            function closeSidebar() {
                sidebarOpen = false;
                
                // Close sidebar
                mobileSidebar.classList.remove('translate-x-0');
                mobileSidebar.classList.add('-translate-x-full');
                
                mobileOverlay.classList.remove('opacity-100', 'visible');
                mobileOverlay.classList.add('opacity-0', 'invisible');
                
                // Toggle icons back
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                
                // Restore body scroll
                document.body.style.overflow = '';
                
                hamburgerBtn.setAttribute('aria-expanded', 'false');
            }
            
            // Event listeners
            if (hamburgerBtn) {
                hamburgerBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleSidebar();
                });
            }
            
            // Close sidebar when clicking overlay
            if (mobileOverlay) {
                mobileOverlay.addEventListener('click', function() {
                    closeSidebar();
                });
            }
            
            // Close sidebar when clicking sidebar links
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    setTimeout(closeSidebar, 100);
                });
            });
            
            // Close sidebar on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && sidebarOpen) {
                    closeSidebar();
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024 && sidebarOpen) {
                    closeSidebar();
                }
            });

            // User dropdown functionality (desktop only)
            const userMenuButton = document.getElementById('userMenuButton');
            const userMenuDropdown = document.getElementById('userMenuDropdown');
            const userMenuChevron = document.getElementById('userMenuChevron');
            
            if (userMenuButton && userMenuDropdown) {
                let isOpen = false;
                
                userMenuButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    isOpen = !isOpen;
                    
                    if (isOpen) {
                        userMenuDropdown.classList.add('show');
                        userMenuDropdown.classList.remove('opacity-0', 'scale-95');
                        userMenuDropdown.classList.add('opacity-100', 'scale-100');
                        userMenuChevron.classList.add('rotate-180');
                        userMenuButton.setAttribute('aria-expanded', 'true');
                    } else {
                        closeDropdown();
                    }
                });
                
                function closeDropdown() {
                    isOpen = false;
                    userMenuDropdown.classList.remove('show', 'opacity-100', 'scale-100');
                    userMenuDropdown.classList.add('opacity-0', 'scale-95');
                    userMenuChevron.classList.remove('rotate-180');
                    userMenuButton.setAttribute('aria-expanded', 'false');
                    
                    setTimeout(() => {
                        if (!isOpen) {
                            userMenuDropdown.classList.remove('show');
                        }
                    }, 200);
                }
                
                // Close on click outside
                document.addEventListener('click', function(e) {
                    if (isOpen && !userMenuButton.contains(e.target) && !userMenuDropdown.contains(e.target)) {
                        closeDropdown();
                    }
                });
                
                // Close on escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && isOpen) {
                        closeDropdown();
                    }
                });
                
                // Close on menu item click
                const menuLinks = userMenuDropdown.querySelectorAll('a, button[type="submit"]');
                menuLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        closeDropdown();
                    });
                });
            }
        });
    </script>
</body>
</html>
