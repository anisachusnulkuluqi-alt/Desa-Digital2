<?php

namespace App\Http\Controllers;

use App\Models\WisataDesa;
use App\Models\Desa;
use Illuminate\Http\Request;

class WisataDesaController extends Controller
{
    public function index()
    {
        $wisata = WisataDesa::with('desa')->latest()->paginate(10);
        return view('wisata.index', compact('wisata'));
    }

    public function create()
    {
        $desas = Desa::all();
        return view('wisata.create', compact('desas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_wisata' => 'required|string|max:150',
            'desa_id' => 'required|exists:desa,id',
            'kategori' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'harga_tiket' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto_url' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Non-Aktif',
        ]);

        WisataDesa::create($validated);

        return redirect()->route('wisata.index')
            ->with('success', 'Wisata berhasil ditambahkan!');
    }

    public function show(WisataDesa $wisata)
    {
        return view('wisata.show', compact('wisata'));
    }

    public function edit(WisataDesa $wisata)
    {
        $desas = Desa::all();
        return view('wisata.edit', compact('wisata', 'desas'));
    }

    public function update(Request $request, WisataDesa $wisata)
    {
        $validated = $request->validate([
            'nama_wisata' => 'required|string|max:150',
            'desa_id' => 'required|exists:desa,id',
            'kategori' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'harga_tiket' => 'nullable|numeric',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto_url' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Non-Aktif',
        ]);

        $wisata->update($validated);

        return redirect()->route('wisata.index')
            ->with('success', 'Wisata berhasil diupdate!');
    }

    public function destroy(WisataDesa $wisata)
    {
        $wisata->delete();

        return redirect()->route('wisata.index')
            ->with('success', 'Wisata berhasil dihapus!');
    }
}