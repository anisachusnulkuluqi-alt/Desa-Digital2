<?php

namespace App\Http\Controllers;

use App\Models\WifiDesa;
use App\Models\Desa;
use Illuminate\Http\Request;

class WifiDesaController extends Controller
{
    // Tampilkan daftar WiFi desa
    public function index()
    {
        $wifi = WifiDesa::with('desa')->latest()->paginate(10);
        return view('wifi.index', compact('wifi'));
    }

    // Tampilkan form tambah WiFi desa
    public function create()
    {
        $desas = Desa::all();
        return view('wifi.create', compact('desas'));
    }

    // Simpan WiFi desa baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'required|string|max:150',
            'desa_id' => 'required|exists:desa,id',
            'alamat' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'kecepatan_mbps' => 'nullable|integer|min:0',
            'status' => 'required|in:Aktif,Non-Aktif',
        ]);

        WifiDesa::create($validated);

        return redirect()->route('wifi.index')
            ->with('success', 'WiFi desa berhasil ditambahkan!');
    }

    // Tampilkan detail WiFi desa
    public function show(WifiDesa $wifi)
    {
        $wifi->load('desa.kecamatan');
        return view('wifi.show', compact('wifi'));
    }

    // Tampilkan form edit WiFi desa
    public function edit(WifiDesa $wifi)
    {
        $desas = Desa::all();
        return view('wifi.edit', compact('wifi', 'desas'));
    }

    // Update WiFi desa
    public function update(Request $request, WifiDesa $wifi)
    {
        $validated = $request->validate([
            'nama_lokasi' => 'required|string|max:150',
            'desa_id' => 'required|exists:desa,id',
            'alamat' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'kecepatan_mbps' => 'nullable|integer|min:0',
            'status' => 'required|in:Aktif,Non-Aktif',
        ]);

        $wifi->update($validated);

        return redirect()->route('wifi.index')
            ->with('success', 'WiFi desa berhasil diupdate!');
    }

    // Hapus WiFi desa
    public function destroy(WifiDesa $wifi)
    {
        $wifi->delete();

        return redirect()->route('wifi.index')
            ->with('success', 'WiFi desa berhasil dihapus!');
    }
}