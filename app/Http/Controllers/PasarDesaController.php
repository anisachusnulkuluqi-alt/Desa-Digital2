<?php

namespace App\Http\Controllers;

use App\Models\PasarDesa;
use App\Models\Desa;
use Illuminate\Http\Request;

class PasarDesaController extends Controller
{
    // Tampilkan daftar pasar desa
    public function index()
    {
        $pasar = PasarDesa::with('desa')->latest()->paginate(10);
        return view('pasar.index', compact('pasar'));
    }

    // Tampilkan form tambah pasar desa
    public function create()
    {
        $desas = Desa::all();
        return view('pasar.create', compact('desas'));
    }

    // Simpan pasar desa baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pasar' => 'required|string|max:150',
            'desa_id' => 'required|exists:desa,id',
            'alamat' => 'nullable|string',
            'hari_operasional' => 'nullable|string|max:100',
            'komoditas_utama' => 'nullable|string',
            'jumlah_pedagang' => 'nullable|integer|min:0',
        ]);

        PasarDesa::create($validated);

        return redirect()->route('pasar.index')
            ->with('success', 'Pasar desa berhasil ditambahkan!');
    }

    // Tampilkan detail pasar desa
    public function show(PasarDesa $pasar)
    {
        $pasar->load('desa.kecamatan');
        return view('pasar.show', compact('pasar'));
    }

    // Tampilkan form edit pasar desa
    public function edit(PasarDesa $pasar)
    {
        $desas = Desa::all();
        return view('pasar.edit', compact('pasar', 'desas'));
    }

    // Update pasar desa
    public function update(Request $request, PasarDesa $pasar)
    {
        $validated = $request->validate([
            'nama_pasar' => 'required|string|max:150',
            'desa_id' => 'required|exists:desa,id',
            'alamat' => 'nullable|string',
            'hari_operasional' => 'nullable|string|max:100',
            'komoditas_utama' => 'nullable|string',
            'jumlah_pedagang' => 'nullable|integer|min:0',
        ]);

        $pasar->update($validated);

        return redirect()->route('pasar.index')
            ->with('success', 'Pasar desa berhasil diupdate!');
    }

    // Hapus pasar desa
    public function destroy(PasarDesa $pasar)
    {
        $pasar->delete();

        return redirect()->route('pasar.index')
            ->with('success', 'Pasar desa berhasil dihapus!');
    }
}