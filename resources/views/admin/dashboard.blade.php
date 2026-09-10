@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')

<!-- Welcome Card -->
<div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-6 mb-6 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name ?? 'Administrator' }}!</h1>
            <p class="text-blue-100">Ini adalah panel administrasi Portal Desa Digital Kabupaten Tuban</p>
        </div>
        <i class="fas fa-chart-line text-6xl text-blue-300 opacity-50"></i>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    
    <!-- Kecamatan -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-blue-100 p-3 rounded-lg">
                <i class="fas fa-map text-blue-600 text-xl"></i>
            </div>
            <span class="text-green-500 text-sm font-medium">
                <i class="fas fa-arrow-up"></i> Aktif
            </span>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">Total Kecamatan</h3>
        <p class="text-3xl font-bold text-gray-800">{{ $totalKecamatan ?? 0 }}</p>
        <a href="{{ route('admin.kecamatan.index') }}" class="text-blue-600 text-sm mt-3 inline-block hover:underline">
            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <!-- Desa -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-green-100 p-3 rounded-lg">
                <i class="fas fa-village text-green-600 text-xl"></i>
            </div>
            <span class="text-green-500 text-sm font-medium">
                <i class="fas fa-arrow-up"></i> Aktif
            </span>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">Total Desa</h3>
        <p class="text-3xl font-bold text-gray-800">{{ $totalDesa ?? 0 }}</p>
        <a href="{{ route('admin.desa.index') }}" class="text-green-600 text-sm mt-3 inline-block hover:underline">
            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <!-- Wisata -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-purple-100 p-3 rounded-lg">
                <i class="fas fa-mountain-sun text-purple-600 text-xl"></i>
            </div>
            <span class="text-green-500 text-sm font-medium">
                <i class="fas fa-arrow-up"></i> Aktif
            </span>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">Wisata Desa</h3>
        <p class="text-3xl font-bold text-gray-800">{{ $totalWisata ?? 0 }}</p>
        <a href="#" class="text-purple-600 text-sm mt-3 inline-block hover:underline">
            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>

    <!-- BUMDes -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-orange-100 p-3 rounded-lg">
                <i class="fas fa-briefcase text-orange-600 text-xl"></i>
            </div>
            <span class="text-green-500 text-sm font-medium">
                <i class="fas fa-arrow-up"></i> Aktif
            </span>
        </div>
        <h3 class="text-gray-500 text-sm font-medium mb-1">BUMDes</h3>
        <p class="text-3xl font-bold text-gray-800">{{ $totalBumdes ?? 0 }}</p>
        <a href="#" class="text-orange-600 text-sm mt-3 inline-block hover:underline">
            Lihat Detail <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    
    <!-- Recent Activities -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-clock-rotate-left text-blue-600 mr-2"></i>
            Aktivitas Terbaru
        </h3>
        <div class="space-y-3">
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <div class="bg-blue-100 p-2 rounded-full">
                    <i class="fas fa-plus text-blue-600 text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">Data desa ditambahkan</p>
                    <p class="text-xs text-gray-500">2 menit yang lalu</p>
                </div>
            </div>
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <div class="bg-green-100 p-2 rounded-full">
                    <i class="fas fa-edit text-green-600 text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">Kecamatan diperbarui</p>
                    <p class="text-xs text-gray-500">1 jam yang lalu</p>
                </div>
            </div>
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                <div class="bg-purple-100 p-2 rounded-full">
                    <i class="fas fa-user-plus text-purple-600 text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">User baru terdaftar</p>
                    <p class="text-xs text-gray-500">3 jam yang lalu</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-bolt text-yellow-500 mr-2"></i>
            Akses Cepat
        </h3>
        <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('admin.kecamatan.create') }}" class="flex items-center space-x-3 p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                <i class="fas fa-plus-circle text-blue-600 text-xl"></i>
                <span class="text-sm font-medium text-gray-800">Tambah Kecamatan</span>
            </a>
            <a href="{{ route('admin.desa.create') }}" class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                <i class="fas fa-plus-circle text-green-600 text-xl"></i>
                <span class="text-sm font-medium text-gray-800">Tambah Desa</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                <i class="fas fa-file-export text-purple-600 text-xl"></i>
                <span class="text-sm font-medium text-gray-800">Export Data</span>
            </a>
            <a href="#" class="flex items-center space-x-3 p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition">
                <i class="fas fa-chart-bar text-orange-600 text-xl"></i>
                <span class="text-sm font-medium text-gray-800">Laporan</span>
            </a>
        </div>
    </div>
</div>

@endsection