<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function index()
    {
        $desas = Desa::with('kecamatan')->latest()->paginate(10);
        return view('desa.index', compact('desas'));
    }

    public function create()
    {
        $kecamatans = Kecamatan::all();
        return view('desa.create', compact('kecamatans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_desa' => 'required|string|max:100',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kode_desa' => 'required|string|max:20|unique:desa,kode_desa',
            'luas_wilayah' => 'nullable|numeric',
            'jumlah_penduduk' => 'nullable|integer',
            'jumlah_kk' => 'nullable|integer',
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'alamat_kantor' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto_url' => 'nullable|string|max:255',
        ]);

        Desa::create($validated);

        return redirect()->route('desa.index')
            ->with('success', 'Desa berhasil ditambahkan!');
    }

    public function show(Desa $desa)
    {
        $desa->load(['kecamatan', 'dusun', 'wisata', 'pasar', 'wifi', 'bumdes', 'kkdmp']);
        return view('desa.show', compact('desa'));
    }

    public function edit(Desa $desa)
    {
        $kecamatans = Kecamatan::all();
        return view('desa.edit', compact('desa', 'kecamatans'));
    }

    public function update(Request $request, Desa $desa)
    {
        $validated = $request->validate([
            'nama_desa' => 'required|string|max:100',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kode_desa' => 'required|string|max:20|unique:desa,kode_desa,' . $desa->id,
            'luas_wilayah' => 'nullable|numeric',
            'jumlah_penduduk' => 'nullable|integer',
            'jumlah_kk' => 'nullable|integer',
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'alamat_kantor' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto_url' => 'nullable|string|max:255',
        ]);

        $desa->update($validated);

        return redirect()->route('desa.index')
            ->with('success', 'Desa berhasil diupdate!');
    }

    public function destroy(Desa $desa)
    {
        $desa->delete();

        return redirect()->route('desa.index')
            ->with('success', 'Desa berhasil dihapus!');
    }
}