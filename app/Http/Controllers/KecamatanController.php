<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::orderBy('nama_kecamatan', 'asc')->get();
        $totalKecamatan = Kecamatan::count();
        $totalDesa = Desa::count();

        return view('admin.kecamatan.index', compact(
            'kecamatans',
            'totalKecamatan',
            'totalDesa'
        ));
    }

    public function create()
    {
        return view('admin.kecamatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kecamatan' => 'required|string|max:255|unique:kecamatan,nama_kecamatan',
        ], [
            'nama_kecamatan.required' => 'Nama kecamatan wajib diisi',
            'nama_kecamatan.unique' => 'Nama kecamatan sudah ada',
        ]);

        Kecamatan::create([
            'nama_kecamatan' => $request->nama_kecamatan,
        ]);

        return redirect()
            ->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil ditambahkan!');
    }

    public function edit(Kecamatan $kecamatan)
    {
        return view('admin.kecamatan.edit', compact('kecamatan'));
    }

    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'nama_kecamatan' => 'required|string|max:255|unique:kecamatan,nama_kecamatan,' . $kecamatan->id,
        ], [
            'nama_kecamatan.required' => 'Nama kecamatan wajib diisi',
            'nama_kecamatan.unique' => 'Nama kecamatan sudah digunakan',
        ]);

        $kecamatan->update([
            'nama_kecamatan' => $request->nama_kecamatan,
        ]);

        return redirect()
            ->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil diperbarui!');
    }

    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();

        return redirect()
            ->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil dihapus!');
    }
}