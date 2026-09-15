<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dusun;
use App\Models\Desa;
use Illuminate\Http\Request;

class DusunController extends Controller
{
    public function index(Request $request)
    {
        $query = Dusun::with('desa');
        
        if ($request->has('search') && $request->search) {
            $query->where('nama_dusun', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('desa_id') && $request->desa_id) {
            $query->where('desa_id', $request->desa_id);
        }
        
        $dusuns = $query->orderBy('nama_dusun')->paginate(10);
        $desas = Desa::orderBy('nama_desa')->get();
        
        return view('admin.dusun.index', compact('dusuns', 'desas'));
    }

    public function create()
    {
        $desas = Desa::orderBy('nama_desa')->get();
        return view('admin.dusun.create', compact('desas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_dusun' => 'required|string|max:100',
            'desa_id' => 'required|exists:desa,id',
            'kepala_dusun' => 'nullable|string|max:100',
            'jumlah_rt' => 'nullable|integer|min:0',
            'jumlah_rw' => 'nullable|integer|min:0',
            'jumlah_kk' => 'nullable|integer|min:0',
            'jumlah_penduduk' => 'nullable|integer|min:0',
            'alamat' => 'nullable|string',
        ]);

        Dusun::create($validated);

        return redirect()->route('admin.dusun.index')
            ->with('success', 'Dusun berhasil ditambahkan!');
    }

    public function show($id)
    {
        $dusun = Dusun::with('desa')->findOrFail($id);
        return view('admin.dusun.show', compact('dusun'));
    }

    public function edit($id)
    {
        $dusun = Dusun::findOrFail($id);
        $desas = Desa::orderBy('nama_desa')->get();
        return view('admin.dusun.edit', compact('dusun', 'desas'));
    }

    public function update(Request $request, $id)
    {
        $dusun = Dusun::findOrFail($id);

        $validated = $request->validate([
            'nama_dusun' => 'required|string|max:100',
            'desa_id' => 'required|exists:desa,id',
            'kepala_dusun' => 'nullable|string|max:100',
            'jumlah_rt' => 'nullable|integer|min:0',
            'jumlah_rw' => 'nullable|integer|min:0',
            'jumlah_kk' => 'nullable|integer|min:0',
            'jumlah_penduduk' => 'nullable|integer|min:0',
            'alamat' => 'nullable|string',
        ]);

        $dusun->update($validated);

        return redirect()->route('admin.dusun.index')
            ->with('success', 'Dusun berhasil diupdate!');
    }

    public function destroy($id)
    {
        $dusun = Dusun::findOrFail($id);
        $dusun->delete();

        return redirect()->route('admin.dusun.index')
            ->with('success', 'Dusun berhasil dihapus!');
    }
}