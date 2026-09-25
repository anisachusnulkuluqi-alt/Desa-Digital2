<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PasarDesa;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PasarController extends Controller
{
    /**
     * Tampilkan daftar pasar desa
     */
    public function index(Request $request)
    {
        // ✅ Gunakan PasarDesa, bukan Pasar
        $query = PasarDesa::with('desa');
        
        if ($request->filled('search')) {
            $query->where('nama_pasar', 'like', '%' . $request->search . '%');
        }
        
        // ✅ Gunakan variabel $pasars (jamak) agar cocok dengan Blade
        $pasars = $query->orderBy('nama_pasar', 'asc')->get();
        $totalPasar = PasarDesa::count();
        $totalDesa = Desa::count();

        // ✅ Panggil view admin.pasar.index
        return view('admin.pasar.index', compact('pasars', 'totalPasar', 'totalDesa'));
    }

    /**
     * Simpan pasar desa baru (AJAX)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pasar' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'desa_id' => 'nullable|exists:desa,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');
        $data['status'] = $request->status ?? 'aktif';
        
        // Handle upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('pasar', 'public');
        }

        $pasar = PasarDesa::create($data);

        // ✅ WAJIB: Kembalikan JSON agar frontend AJAX bisa membacanya
        return response()->json([
            'success' => true,
            'message' => 'Pasar berhasil ditambahkan!',
            'data' => $pasar
        ]);
    }

    /**
     * Update pasar desa (AJAX)
     */
    public function update(Request $request, PasarDesa $pasar)
    {
        $request->validate([
            'nama_pasar' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'desa_id' => 'nullable|exists:desa,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');
        $data['status'] = $request->status ?? 'aktif';
        
        // Handle upload foto baru & hapus foto lama
        if ($request->hasFile('foto')) {
            if ($pasar->foto) {
                Storage::disk('public')->delete($pasar->foto);
            }
            $data['foto'] = $request->file('foto')->store('pasar', 'public');
        }

        $pasar->update($data);

        // ✅ WAJIB: Kembalikan JSON
        return response()->json([
            'success' => true,
            'message' => 'Pasar berhasil diperbarui!',
            'data' => $pasar
        ]);
    }

    /**
     * Hapus pasar desa (AJAX)
     */
    public function destroy(PasarDesa $pasar)
    {
        // Hapus foto dari storage jika ada
        if ($pasar->foto) {
            Storage::disk('public')->delete($pasar->foto);
        }
        
        $pasar->delete();

        // ✅ WAJIB: Kembalikan JSON
        return response()->json([
            'success' => true,
            'message' => 'Data pasar berhasil dihapus!'
        ]);
    }
}