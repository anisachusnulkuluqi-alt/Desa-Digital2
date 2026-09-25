<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bumdes;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BumdesController extends Controller
{
    public function index()
    {
        $bumdes = Bumdes::orderBy('nama_bumdes', 'asc')->get();
        $totalBumdes = Bumdes::count();
        $totalDesa = Desa::count();

        return view('admin.bumdes.index', compact('bumdes', 'totalBumdes', 'totalDesa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_bumdes' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'nama_ketua' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('bumdes', 'public');
        }

        Bumdes::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data BUMDes berhasil ditambahkan!'
        ]);
    }

    public function update(Request $request, Bumdes $bumdes)
    {
        $request->validate([
            'nama_bumdes' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'nama_ketua' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            if ($bumdes->foto) {
                Storage::disk('public')->delete($bumdes->foto);
            }
            $data['foto'] = $request->file('foto')->store('bumdes', 'public');
        }

        $bumdes->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data BUMDes berhasil diperbarui!'
        ]);
    }

    public function destroy(Bumdes $bumdes)
    {
        if ($bumdes->foto) {
            Storage::disk('public')->delete($bumdes->foto);
        }
        
        $bumdes->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data BUMDes berhasil dihapus!'
        ]);
    }
}