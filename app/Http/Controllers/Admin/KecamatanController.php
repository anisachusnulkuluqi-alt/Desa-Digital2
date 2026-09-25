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
        
        $kecamatan = $query->orderBy('nama_kecamatan', 'asc')->get();
        $totalKecamatan = Kecamatan::count();
        $totalDesa = Desa::count();

        return view('admin.kecamatan.index', compact('kecamatan', 'totalKecamatan', 'totalDesa'));
    }

    public function show(Kecamatan $kecamatan)
    {
        $desas = Desa::where('kecamatan_id', $kecamatan->id)
            ->orderBy('nama_desa', 'asc')
            ->get();

        return view('admin.kecamatan.show', compact('kecamatan', 'desas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
        ]);

        Kecamatan::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data kecamatan berhasil ditambahkan!'
        ]);
    }

    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'nama_kecamatan' => 'required|string|max:255',
        ]);

        $kecamatan->update($request->all());

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