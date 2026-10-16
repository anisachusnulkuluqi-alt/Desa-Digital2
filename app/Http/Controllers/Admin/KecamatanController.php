<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kecamatan::with('desa');
        
        if ($request->filled('search')) {
            $query->where('nama_kecamatan', 'like', '%' . $request->search . '%');
        }
        
        $kecamatan = $query->orderBy('nama_kecamatan', 'asc')->paginate(10)->withQueryString();
        $totalKecamatan = Kecamatan::count();
        $totalDesa = Desa::count();

        return view('admin.kecamatan.index', compact('kecamatan', 'totalKecamatan', 'totalDesa'));
    }

    public function show(Request $request, Kecamatan $kecamatan)
    {
        $query = Desa::where('kecamatan_id', $kecamatan->id);
        if ($request->filled('search')) {
            $query->where('nama_desa', 'like', '%' . $request->search . '%');
        }

        $desas = $query->orderBy('nama_desa', 'asc')->paginate(10)->withQueryString();

        return view('admin.kecamatan.show', compact('kecamatan', 'desas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
            'kode_kecamatan' => 'nullable|string|max:50',
        ]);

        Kecamatan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data kecamatan berhasil ditambahkan!'
        ]);
    }

    public function update(Request $request, Kecamatan $kecamatan)
    {
        $validated = $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
            'kode_kecamatan' => 'nullable|string|max:50',
        ]);

        $kecamatan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data kecamatan berhasil diperbarui!'
        ]);
    }

    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data kecamatan berhasil dihapus!'
        ]);
    }
}