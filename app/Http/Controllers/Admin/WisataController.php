<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    public function index(Request $request)
    {
        $query = Wisata::with('desa');
        
        if ($request->filled('search')) {
            $query->where('nama_wisata', 'like', '%' . $request->search . '%');
        }
        
        $wisatas = $query->orderBy('nama_wisata', 'asc')->get();
        $totalWisata = Wisata::count();
        $totalDesa = Desa::count();

        return view('admin.wisata.index', compact('wisatas', 'totalWisata', 'totalDesa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'desa_id' => 'nullable|exists:desa,id',
            'jenis' => 'nullable|string|max:100',
            'jam_operasional' => 'nullable|string|max:255',
            'htm' => 'nullable|string|max:100',
            'reservasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('wisata', 'public');
        }

        Wisata::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data wisata berhasil ditambahkan!'
        ]);
    }

    public function update(Request $request, Wisata $wisata)
    {
        $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'desa_id' => 'nullable|exists:desa,id',
            'jenis' => 'nullable|string|max:100',
            'jam_operasional' => 'nullable|string|max:255',
            'htm' => 'nullable|string|max:100',
            'reservasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            if ($wisata->foto) {
                Storage::disk('public')->delete($wisata->foto);
            }
            $data['foto'] = $request->file('foto')->store('wisata', 'public');
        }

        $wisata->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data wisata berhasil diperbarui!'
        ]);
    }

    public function destroy(Wisata $wisata)
    {
        if ($wisata->foto) {
            Storage::disk('public')->delete($wisata->foto);
        }
        
        $wisata->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data wisata berhasil dihapus!'
        ]);
    }
}