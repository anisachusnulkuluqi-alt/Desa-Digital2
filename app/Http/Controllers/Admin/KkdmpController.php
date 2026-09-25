<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kkdmp;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KkdmpController extends Controller
{
    public function index()
    {
        $kkdmp = Kkdmp::orderBy('nama_desa', 'asc')->get();
        $totalKkdmp = Kkdmp::count();
        $totalDesa = Desa::count();

        return view('admin.kkdmp.index', compact('kkdmp', 'totalKkdmp', 'totalDesa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_desa' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'nama_ketua' => 'nullable|string|max:255',
            'no_ahu' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('kkdmp', 'public');
        }

        Kkdmp::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data KKDMP berhasil ditambahkan!'
        ]);
    }

    public function update(Request $request, Kkdmp $kkdmp)
    {
        $request->validate([
            'nama_desa' => 'required|string|max:255',
            'jenis' => 'nullable|string|max:255',
            'nama_ketua' => 'nullable|string|max:255',
            'no_ahu' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            if ($kkdmp->foto) {
                Storage::disk('public')->delete($kkdmp->foto);
            }
            $data['foto'] = $request->file('foto')->store('kkdmp', 'public');
        }

        $kkdmp->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data KKDMP berhasil diperbarui!'
        ]);
    }

    public function destroy(Kkdmp $kkdmp)
    {
        if ($kkdmp->foto) {
            Storage::disk('public')->delete($kkdmp->foto);
        }
        
        $kkdmp->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data KKDMP berhasil dihapus!'
        ]);
    }
}