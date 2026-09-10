<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Portal Desa Digital')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR -->
        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <!-- Logo -->
            <div class="p-6 border-b border-slate-800">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-600 p-2 rounded-lg">
                        <i class="fas fa-building-columns text-xl"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-lg">Admin Panel</h1>
                        <p class="text-xs text-slate-400">Desa Digital Tuban</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4">
                <div class="px-4 mb-2 text-xs font-semibold text-slate-400 uppercase">Menu Utama</div>
                
                <a href="{{ url('/admin/dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }} transition">
                    <i class="fas fa-tachometer-alt w-6"></i>
                    <span>Dashboard</span>
                </a>

                <div class="px-4 mt-6 mb-2 text-xs font-semibold text-slate-400 uppercase">Manajemen Data</div>
                
                <a href="{{ route('admin.kecamatan.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.kecamatan.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }} transition">
                    <i class="fas fa-map w-6"></i>
                    <span>Kecamatan</span>
                </a>

                <a href="{{ route('admin.desa.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.desa.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:bg-slate-800' }} transition">
                    <i class="fas fa-village w-6"></i>
                    <span>Desa</span>
                </a>

                <a href="#" class="flex items-center px-6 py-3 text-slate-300 hover:bg-slate-800 transition">
                    <i class="fas fa-home w-6"></i>
                    <span>Dusun</span>
                </a>

                <a href="#" class="flex items-center px-6 py-3 text-slate-300 hover:bg-slate-800 transition">
                    <i class="fas fa-mountain-sun w-6"></i>
                    <span>Wisata Desa</span>
                </a>

                <a href="#" class="flex items-center px-6 py-3 text-slate-300 hover:bg-slate-800 transition">
                    <i class="fas fa-store w-6"></i>
                    <span>Pasar Desa</span>
                </a>

                <a href="#" class="flex items-center px-6 py-3 text-slate-300 hover:bg-slate-800 transition">
                    <i class="fas fa-wifi w-6"></i>
                    <span>WiFi Desa</span>
                </a>

                <a href="#" class="flex items-center px-6 py-3 text-slate-300 hover:bg-slate-800 transition">
                    <i class="fas fa-briefcase w-6"></i>
                    <span>BUMDes</span>
                </a>

                <a href="#" class="flex items-center px-6 py-3 text-slate-300 hover:bg-slate-800 transition">
                    <i class="fas fa-clipboard-list w-6"></i>
                    <span>KKDMP</span>
                </a>

                <div class="px-4 mt-6 mb-2 text-xs font-semibold text-slate-400 uppercase">Lainnya</div>
                
                <a href="/" class="flex items-center px-6 py-3 text-slate-300 hover:bg-slate-800 transition">
                    <i class="fas fa-external-link-alt w-6"></i>
                    <span>Lihat Frontend</span>
                </a>
            </nav>

            <!-- User Info -->
            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center space-x-3">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=3B82F6&color=fff" class="w-10 h-10 rounded-full">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email ?? 'admin@tuban.go.id' }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- TOP BAR -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <button class="md:hidden text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="relative text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                        </button>

                        <!-- User Dropdown -->
                        <div class="relative" id="userDropdown">
                            <button onclick="toggleDropdown()" class="flex items-center space-x-2 focus:outline-none">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=3B82F6&color=fff" class="w-9 h-9 rounded-full">
                                <i class="fas fa-chevron-down text-xs text-gray-600"></i>
                            </button>

                            <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-100">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-user mr-2"></i> Profil Saya
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                    <i class="fas fa-cog mr-2"></i> Pengaturan
                                </a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const menu = document.getElementById('dropdownMenu');
            if (!dropdown.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>