<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    public function index(Request $request)
    {
        $query = Wisata::query();

        // Fitur pencarian
        if ($request->filled('search')) {
            $query->where('nama_lokasi', 'like', '%' . $request->search . '%');
        }

        $wisatas = $query->orderBy('nama_lokasi', 'asc')->paginate(10);

        // Statistik
        $totalDenganKoordinat = Wisata::whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->count();
        
        $totalDenganFoto = Wisata::whereNotNull('properties')
            ->where('properties', 'like', '%"foto":"http%"')
            ->count();

        return view('admin.wisata.index', compact('wisatas', 'totalDenganKoordinat', 'totalDenganFoto'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lokasi'     => 'required|string|max:255',
            'desa'            => 'nullable|string|max:255',
            'jenis_wisata'    => 'nullable|string|max:100',
            'jam_operasional' => 'nullable|string|max:100',
            'htm'             => 'nullable|string|max:50',
            'reservasi'       => 'nullable|string|max:255',
            'deskripsi'       => 'nullable|string',
            'latitude'        => 'nullable|string|max:50',
            'longitude'       => 'nullable|string|max:50',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle upload foto
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('wisata', 'public');
            $fotoPath = asset('storage/' . $fotoPath);
        }

        $properties = [
            'desa' => $validated['desa'] ?? null,
            'jenis' => $validated['jenis_wisata'] ?? null,
            'jam_operasional' => $validated['jam_operasional'] ?? null,
            'htm' => $validated['htm'] ?? null,
            'reservasi' => $validated['reservasi'] ?? null,
            'deskripsi' => $validated['deskripsi'] ?? null,
            'foto' => $fotoPath,
        ];

        // ✅ PERBAIKAN: Menambahkan feature_key agar tidak error default value
        Wisata::create([
            'feature_key' => 'wk_' . uniqid() . '_' . time(),
            'nama_lokasi' => $validated['nama_lokasi'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'properties' => json_encode($properties),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data wisata berhasil ditambahkan!'
        ]);
    }

    public function update(Request $request, $id)
    {
        $wisata = Wisata::findOrFail($id);

        $validated = $request->validate([
            'nama_lokasi'     => 'required|string|max:255',
            'desa'            => 'nullable|string|max:255',
            'jenis_wisata'    => 'nullable|string|max:100',
            'jam_operasional' => 'nullable|string|max:100',
            'htm'             => 'nullable|string|max:50',
            'reservasi'       => 'nullable|string|max:255',
            'deskripsi'       => 'nullable|string',
            'latitude'        => 'nullable|string|max:50',
            'longitude'       => 'nullable|string|max:50',
            'foto'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Parse properties lama
        $oldProperties = [];
        if (!empty($wisata->properties)) {
            $oldProperties = is_string($wisata->properties) ? json_decode($wisata->properties, true) : $wisata->properties;
        }

        // Handle upload foto baru
        $fotoPath = $oldProperties['foto'] ?? null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('wisata', 'public');
            $fotoPath = asset('storage/' . $fotoPath);
        }

        $newProperties = array_merge($oldProperties, [
            'desa' => $validated['desa'],
            'jenis' => $validated['jenis_wisata'],
            'jam_operasional' => $validated['jam_operasional'],
            'htm' => $validated['htm'],
            'reservasi' => $validated['reservasi'],
            'deskripsi' => $validated['deskripsi'],
            'foto' => $fotoPath,
        ]);

        $wisata->update([
            'nama_lokasi' => $validated['nama_lokasi'],
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'properties' => json_encode($newProperties),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data wisata berhasil diperbarui!'
        ]);
    }

    public function destroy($id)
    {
        $wisata = Wisata::findOrFail($id);
        $wisata->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data wisata berhasil dihapus!'
        ]);
    }
}