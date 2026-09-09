<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    // Tampilkan daftar kecamatan
    public function index()
    {
        $kecamatans = Kecamatan::withCount('desa')->latest()->paginate(10);
        return view('kecamatan.index', compact('kecamatans'));
    }

    // Tampilkan form tambah kecamatan
    public function create()
    {
        return view('kecamatan.create');
    }

    // Simpan kecamatan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kecamatan' => 'required|string|max:100',
            'kode_wilayah' => 'required|string|max:20|unique:kecamatan,kode_wilayah',
        ]);

        Kecamatan::create($validated);

        return redirect()->route('kecamatan.index')
            ->with('success', 'Kecamatan berhasil ditambahkan!');
    }

    // Tampilkan detail kecamatan
    public function show(Kecamatan $kecamatan)
    {
        $kecamatan->load('desa');
        return view('kecamatan.show', compact('kecamatan'));
    }

    // Tampilkan form edit kecamatan
    public function edit(Kecamatan $kecamatan)
    {
        return view('kecamatan.edit', compact('kecamatan'));
    }

    // Update kecamatan
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $validated = $request->validate([
            'nama_kecamatan' => 'required|string|max:100',
            'kode_wilayah' => 'required|string|max:20|unique:kecamatan,kode_wilayah,' . $kecamatan->id,
        ]);

        $kecamatan->update($validated);

        return redirect()->route('kecamatan.index')
            ->with('success', 'Kecamatan berhasil diupdate!');
    }

    // Hapus kecamatan
    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();

        return redirect()->route('kecamatan.index')
            ->with('success', 'Kecamatan berhasil dihapus!');
    }
}