<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KantorDesa;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KantorDesaController extends Controller
{
    public function index()
    {
        $kantors = KantorDesa::with('desa')->orderBy('nama_kantor', 'asc')->get();
        $totalKantor = KantorDesa::count();
        $totalDesa = Desa::count();

        return view('admin.kantor.index', compact('kantors', 'totalKantor', 'totalDesa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kantor' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'link_maps' => 'nullable|url|max:500',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'desa_id' => 'nullable|exists:desa,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kantor', 'public');
        }

        KantorDesa::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Kantor berhasil ditambahkan!'
        ]);
    }

    public function update(Request $request, KantorDesa $kantor)
    {
        $request->validate([
            'nama_kantor' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'link_maps' => 'nullable|url|max:500',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'desa_id' => 'nullable|exists:desa,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            if ($kantor->foto) {
                Storage::disk('public')->delete($kantor->foto);
            }
            $data['foto'] = $request->file('foto')->store('kantor', 'public');
        }

        $kantor->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Kantor berhasil diperbarui!'
        ]);
    }

    public function destroy(KantorDesa $kantor)
    {
        if ($kantor->foto) {
            Storage::disk('public')->delete($kantor->foto);
        }
        
        $kantor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data kantor berhasil dihapus!'
        ]);
    }
}