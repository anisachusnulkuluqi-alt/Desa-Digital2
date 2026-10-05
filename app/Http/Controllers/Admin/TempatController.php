<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tempat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TempatController extends Controller
{
    /**
     * Tampilkan semua tempat (master)
     */
    public function index(Request $request)
    {
        $query = Tempat::query();

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('desa', 'like', '%' . $request->search . '%');
        }

        $tempats = $query->orderBy('nama', 'asc')->paginate(15);
        $totalTempat = Tempat::count();
        $totalKategori = Tempat::select('kategori')->distinct()->count();
        $existingKategori = Tempat::getExistingKategori();

        return view('admin.tempat.index', compact('tempats', 'totalTempat', 'totalKategori', 'existingKategori'));
    }

    /**
     * Tampilkan tempat berdasarkan kategori (untuk menu sidebar dinamis)
     */
    public function showByKategori($kategori)
    {
        $kategori = strtolower(trim($kategori));

        $query = Tempat::where('kategori', $kategori);

        if (request()->filled('search')) {
            $query->where('nama', 'like', '%' . request('search') . '%')
                  ->orWhere('desa', 'like', '%' . request('search') . '%');
        }

        $tempats = $query->orderBy('nama', 'asc')->paginate(15);
        $totalTempat = $query->count();
        $existingKategori = Tempat::getExistingKategori();

        return view('admin.tempat.by-kategori', compact('tempats', 'totalTempat', 'kategori', 'existingKategori'));
    }

    /**
     * Simpan tempat baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'desa'      => 'nullable|string|max:255',
            'alamat'    => 'nullable|string',
            'latitude'  => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('tempat', 'public');
        }

        Tempat::create([
            'nama'          => $validated['nama'],
            'kategori'      => strtolower(trim($validated['kategori'])),
            'desa'          => $validated['desa'] ?? null,
            'alamat'        => $validated['alamat'] ?? null,
            'latitude'      => $validated['latitude'] ?? null,
            'longitude'     => $validated['longitude'] ?? null,
            'foto'          => $fotoPath,
            'deskripsi'     => $validated['deskripsi'] ?? null,
            'info_tambahan' => json_encode($request->info_tambahan ?? []),
        ]);

        return response()->json(['success' => true, 'message' => 'Tempat berhasil ditambahkan!']);
    }

    /**
     * Update tempat
     */
    public function update(Request $request, $id)
    {
        $tempat = Tempat::findOrFail($id);

        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'desa'      => 'nullable|string|max:255',
            'alamat'    => 'nullable|string',
            'latitude'  => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $fotoPath = $tempat->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath) Storage::disk('public')->delete($fotoPath);
            $fotoPath = $request->file('foto')->store('tempat', 'public');
        }

        $tempat->update(array_merge($validated, [
            'kategori'      => strtolower(trim($validated['kategori'])),
            'foto'          => $fotoPath,
            'info_tambahan' => json_encode($request->info_tambahan ?? []),
        ]));

        return response()->json(['success' => true, 'message' => 'Tempat berhasil diperbarui!']);
    }

    /**
     * Hapus tempat
     */
    public function destroy($id)
    {
        $tempat = Tempat::findOrFail($id);
        if ($tempat->foto) Storage::disk('public')->delete($tempat->foto);
        $tempat->delete();

        return response()->json(['success' => true, 'message' => 'Tempat berhasil dihapus!']);
    }

    /**
     * Autocomplete kategori (untuk form input)
     */
    public function autocompleteKategori(Request $request)
    {
        $query = $request->get('q', '');
        $kategori = Tempat::select('kategori')
            ->distinct()
            ->where('kategori', 'like', '%' . $query . '%')
            ->pluck('kategori')
            ->filter()
            ->values();

        return response()->json($kategori);
    }
}