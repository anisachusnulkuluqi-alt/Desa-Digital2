<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    public function index()
    {
        $wisatas = Wisata::orderBy('nama_wisata', 'asc')->get();
        $totalWisata = Wisata::count();

        return view('admin.wisata.index', compact('wisatas', 'totalWisata'));
    }

    public function show(Wisata $wisata)
    {
        return view('admin.wisata.show', compact('wisata'));
    }

    public function create()
    {
        return view('admin.wisata.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'desa' => 'nullable|string|max:255',
            'jam_operasional' => 'nullable|string|max:100',
            'htm' => 'nullable|string|max:100',
            'reservasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt' => 'nullable|string|max:255',
            'jenis_wisata' => 'nullable|string|max:100',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('wisata', 'public');
        }

        Wisata::create($data);

        return redirect()
            ->route('admin.wisata.index')
            ->with('success', 'Wisata berhasil ditambahkan!');
    }

    public function edit(Wisata $wisata)
    {
        return view('admin.wisata.edit', compact('wisata'));
    }

    public function update(Request $request, Wisata $wisata)
    {
        $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'desa' => 'nullable|string|max:255',
            'jam_operasional' => 'nullable|string|max:100',
            'htm' => 'nullable|string|max:100',
            'reservasi' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt' => 'nullable|string|max:255',
            'jenis_wisata' => 'nullable|string|max:100',
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($wisata->foto) {
                Storage::disk('public')->delete($wisata->foto);
            }
            $data['foto'] = $request->file('foto')->store('wisata', 'public');
        }

        $wisata->update($data);

        return redirect()
            ->route('admin.wisata.index')
            ->with('success', 'Wisata berhasil diperbarui!');
    }

    public function destroy(Wisata $wisata)
    {
        if ($wisata->foto) {
            Storage::disk('public')->delete($wisata->foto);
        }

        $wisata->delete();

        return redirect()
            ->route('admin.wisata.index')
            ->with('success', 'Wisata berhasil dihapus!');
    }
}