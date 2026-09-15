<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DesaController extends Controller
{
    public function index(Request $request)
    {
        $query = Desa::with('kecamatan');
        
        if ($request->has('search') && $request->search) {
            $query->where('nama_desa', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('kecamatan_id') && $request->kecamatan_id) {
            $query->where('kecamatan_id', $request->kecamatan_id);
        }
        
        $desas = $query->orderBy('nama_desa')->paginate(10);
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();
        
        $totalDesa = Desa::count();
        $totalKecamatan = Kecamatan::count();
        
        return view('admin.desa.index', compact('desas', 'kecamatans', 'totalDesa', 'totalKecamatan'));
    }

    public function create()
    {
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();
        return view('admin.desa.create', compact('kecamatans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_desa' => 'required|string|max:100',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kode_desa' => 'nullable|string|max:20|unique:desa,kode_desa',
            'kepala_desa' => 'nullable|string|max:100',
            'jumlah_penduduk' => 'nullable|integer|min:0',
            'jumlah_kk' => 'nullable|integer|min:0',
            'luas_wilayah' => 'nullable|numeric|min:0',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        $validated['slug'] = Str::slug($validated['nama_desa']) . '-' . time();
        Desa::create($validated);

        return redirect()->route('admin.desa.index')
            ->with('success', 'Desa berhasil ditambahkan!');
    }

    public function show($id)
    {
        $desa = Desa::with('kecamatan')->findOrFail($id);
        return view('admin.desa.show', compact('desa'));
    }

    public function edit($id)
    {
        $desa = Desa::findOrFail($id);
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();
        return view('admin.desa.edit', compact('desa', 'kecamatans'));
    }

    public function update(Request $request, $id)
    {
        $desa = Desa::findOrFail($id);

        $validated = $request->validate([
            'nama_desa' => 'required|string|max:100',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kode_desa' => 'nullable|string|max:20|unique:desa,kode_desa,' . $id,
            'kepala_desa' => 'nullable|string|max:100',
            'jumlah_penduduk' => 'nullable|integer|min:0',
            'jumlah_kk' => 'nullable|integer|min:0',
            'luas_wilayah' => 'nullable|numeric|min:0',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
        ]);

        if ($desa->nama_desa !== $validated['nama_desa']) {
            $validated['slug'] = Str::slug($validated['nama_desa']) . '-' . time();
        }

        $desa->update($validated);

        return redirect()->route('admin.desa.index')
            ->with('success', 'Desa berhasil diupdate!');
    }

    public function destroy($id)
    {
        $desa = Desa::findOrFail($id);
        $desa->delete();

        return redirect()->route('admin.desa.index')
            ->with('success', 'Desa berhasil dihapus!');
    }
}