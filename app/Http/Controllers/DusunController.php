<?php

namespace App\Http\Controllers;

use App\Models\Dusun;
use App\Models\Desa;
use Illuminate\Http\Request;

class DusunController extends Controller
{
    public function index()
    {
        $dusun = Dusun::with('desa')->latest()->paginate(10);
        return view('dusun.index', compact('dusun'));
    }

    public function create()
    {
        $desas = Desa::all();
        return view('dusun.create', compact('desas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dusun' => 'required|string|max:100',
            'desa_id' => 'required|exists:desa,id',
            'jumlah_rt' => 'nullable|integer',
            'jumlah_penduduk' => 'nullable|integer',
        ]);

        Dusun::create($validated);

        return redirect()->route('dusun.index')
            ->with('success', 'Dusun berhasil ditambahkan!');
    }

    public function show(Dusun $dusun)
    {
        return view('dusun.show', compact('dusun'));
    }

    public function edit(Dusun $dusun)
    {
        $desas = Desa::all();
        return view('dusun.edit', compact('dusun', 'desas'));
    }

    public function update(Request $request, Dusun $dusun)
    {
        $validated = $request->validate([
            'nama_dusun' => 'required|string|max:100',
            'desa_id' => 'required|exists:desa,id',
            'jumlah_rt' => 'nullable|integer',
            'jumlah_penduduk' => 'nullable|integer',
        ]);

        $dusun->update($validated);

        return redirect()->route('dusun.index')
            ->with('success', 'Dusun berhasil diupdate!');
    }

    public function destroy(Dusun $dusun)
    {
        $dusun->delete();

        return redirect()->route('dusun.index')
            ->with('success', 'Dusun berhasil dihapus!');
    }
}