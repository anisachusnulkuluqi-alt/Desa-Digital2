<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DesaController extends Controller
{
    public function index(Request $request)
    {
        $query = Desa::with('kecamatan');
        
        if ($request->filled('search')) {
            $query->where('nama_desa', 'like', '%' . $request->search . '%');
        }
        
        $desas = $query->orderBy('nama_desa', 'asc')->paginate(10)->withQueryString();
        $totalDesa = Desa::count();
        $totalKecamatan = Kecamatan::count();
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();

        return view('admin.desa.index', compact('desas', 'totalDesa', 'totalKecamatan', 'kecamatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_desa' => 'required|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kode_desa' => 'nullable|string|max:50',
            'jenis' => 'required|in:Desa,Kelurahan',
            'website' => 'nullable|url|max:255',
            'youtube' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:50',
        ]);

        Desa::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data desa berhasil ditambahkan!'
        ]);
    }

    public function update(Request $request, Desa $desa)
    {
        $validated = $request->validate([
            'nama_desa' => 'required|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kode_desa' => ['required', 'string', 'max:20', Rule::unique('desa', 'kode_desa')->ignore($desa->id)],
            'jenis' => 'required|in:Desa,Kelurahan',
            'website' => 'nullable|url|max:255',
            'youtube' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'tiktok' => 'nullable|string|max:255',
            'whatsapp' => 'nullable|string|max:50',
        ]);

        $desa->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data desa berhasil diperbarui!'
        ]);
    }

    public function destroy(Desa $desa)
    {
        $desa->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data desa berhasil dihapus!'
        ]);
    }
}