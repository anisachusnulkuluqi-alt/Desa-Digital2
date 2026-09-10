@extends('layouts.admin')

@section('title', 'Detail Kecamatan')
@section('page-title', 'Detail Kecamatan')

@section('content')

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        
        <!-- Header -->
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Detail Kecamatan</h3>
                <p class="text-sm text-gray-500 mt-1">Informasi lengkap kecamatan</p>
            </div>
            <a href="{{ route('admin.kecamatan.edit', $kecamatan->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition">
                <i class="fas fa-edit"></i>
                <span>Edit</span>
            </a>
        </div>

        <!-- Info Cards -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-blue-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Nama Kecamatan</p>
                    <p class="text-xl font-bold text-gray-800">{{ $kecamatan->nama_kecamatan }}</p>
                </div>
                <div class="bg-green-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 mb-1">Kode Wilayah</p>
                    <p class="text-xl font-bold text-gray-800">{{ $kecamatan->kode_wilayah }}</p>
                </div>
            </div>

            <!-- Desa List -->
            <div class="border-t border-gray-100 pt-6">
                <h4 class="text-md font-semibold text-gray-800 mb-4">
                    <i class="fas fa-village text-blue-600 mr-2"></i>
                    Daftar Desa ({{ $kecamatan->desa->count() }})
                </h4>
                
                @if($kecamatan->desa->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($kecamatan->desa as $desa)
                    <div class="bg-gray-50 rounded-lg p-3 flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">{{ $desa->nama_desa }}</p>
                            <p class="text-xs text-gray-500">{{ $desa->kode_desa }}</p>
                        </div>
                        <a href="{{ route('admin.desa.show', $desa->id) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-inbox text-4xl text-gray-300 mb-2"></i>
                    <p>Belum ada desa di kecamatan ini</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="p-6 border-t border-gray-100 flex items-center justify-between">
            <a href="{{ route('admin.kecamatan.index') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
            <form action="{{ route('admin.kecamatan.destroy', $kecamatan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kecamatan ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800">
                    <i class="fas fa-trash mr-2"></i>Hapus Kecamatan
                </button>
            </form>
        </div>
    </div>
</div>

@endsection