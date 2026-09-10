@extends('layouts.admin')

@section('title', 'Edit Kecamatan')
@section('page-title', 'Edit Kecamatan')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Form Edit Kecamatan</h3>
            <p class="text-sm text-gray-500 mt-1">Update data kecamatan</p>
        </div>

        <form action="{{ route('admin.kecamatan.update', $kecamatan->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Kecamatan <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="nama_kecamatan" 
                    value="{{ old('nama_kecamatan', $kecamatan->nama_kecamatan) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_kecamatan') border-red-500 @enderror"
                    required
                >
                @error('nama_kecamatan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Kode Wilayah <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="kode_wilayah" 
                    value="{{ old('kode_wilayah', $kecamatan->kode_wilayah) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kode_wilayah') border-red-500 @enderror"
                    required
                >
                @error('kode_wilayah')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.kecamatan.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-2"></i>Update
                </button>
            </div>
        </form>
    </div>
</div>

@endsection