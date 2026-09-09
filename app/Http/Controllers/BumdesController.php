<?php

namespace App\Http\Controllers;

use App\Models\Bumdes;
use App\Models\Desa;
use Illuminate\Http\Request;

class BumdesController extends Controller
{
    // Tampilkan daftar BUMDes
    public function index()
    {
        $bumdes = Bumdes::with('desa')->latest()->paginate(10);
        return view('bumdes.index', compact('bumdes'));
    }

    // Tampilkan form tambah BUMDes
    public function create()
    {
        $desas = Desa::all();
        return view('bumdes.create', compact('desas'));
    }

    // Simpan BUMDes baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_bumdes' => 'required|string|max:150',
            'desa_id' => 'required|exists:desa,id',
            'jenis_usaha' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'tahun_berdiri' => 'nullable|integer|min:1900|max:' . date('Y'),
            'status' => 'required|in:Aktif,Non-Aktif',
        ]);

        Bumdes::create($validated);

        return redirect()->route('bumdes.index')
            ->with('success', 'BUMDes berhasil ditambahkan!');
    }

    // Tampilkan detail BUMDes
    public function show(Bumdes $bumdes)
    {
        $bumdes->load('desa.kecamatan');
        return view('bumdes.show', compact('bumdes'));
    }

    // Tampilkan form edit BUMDes
    public function edit(Bumdes $bumdes)
    {
        $desas = Desa::all();
        return view('bumdes.edit', compact('bumdes', 'desas'));
    }

    // Update BUMDes
    public function update(Request $request, Bumdes $bumdes)
    {
        $validated = $request->validate([
            'nama_bumdes' => 'required|string|max:150',
            'desa_id' => 'required|exists:desa,id',
            'jenis_usaha' => 'nullable|string|max:100',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'tahun_berdiri' => 'nullable|integer|min:1900|max:' . date('Y'),
            'status' => 'required|in:Aktif,Non-Aktif',
        ]);

        $bumdes->update($validated);

        return redirect()->route('bumdes.index')
            ->with('success', 'BUMDes berhasil diupdate!');
    }

    // Hapus BUMDes
    public function destroy(Bumdes $bumdes)
    {
        $bumdes->delete();

        return redirect()->route('bumdes.index')
            ->with('success', 'BUMDes berhasil dihapus!');
    }
}