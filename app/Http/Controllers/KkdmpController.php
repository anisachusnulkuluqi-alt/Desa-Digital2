<?php

namespace App\Http\Controllers;

use App\Models\Kkdmp;
use App\Models\Desa;
use Illuminate\Http\Request;

class KkdmpController extends Controller
{
    // Tampilkan daftar KKDMP
    public function index()
    {
        $kkdmp = Kkdmp::with('desa')->latest()->paginate(10);
        return view('kkdmp.index', compact('kkdmp'));
    }

    // Tampilkan form tambah KKDMP
    public function create()
    {
        $desas = Desa::all();
        return view('kkdmp.create', compact('desas'));
    }

    // Simpan KKDMP baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_dokumen' => 'required|string|max:200',
            'desa_id' => 'required|exists:desa,id',
            'tahun' => 'nullable|integer|min:2000|max:' . (date('Y') + 5),
            'deskripsi' => 'nullable|string',
            'file_url' => 'nullable|string|max:255',
            'status' => 'required|in:Draft,Published,Archived',
        ]);

        // Handle upload file (jika ada)
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kkdmp'), $fileName);
            $validated['file_url'] = 'uploads/kkdmp/' . $fileName;
        }

        Kkdmp::create($validated);

        return redirect()->route('kkdmp.index')
            ->with('success', 'Dokumen KKDMP berhasil ditambahkan!');
    }

    // Tampilkan detail KKDMP
    public function show(Kkdmp $kkdmp)
    {
        $kkdmp->load('desa.kecamatan');
        return view('kkdmp.show', compact('kkdmp'));
    }

    // Tampilkan form edit KKDMP
    public function edit(Kkdmp $kkdmp)
    {
        $desas = Desa::all();
        return view('kkdmp.edit', compact('kkdmp', 'desas'));
    }

    // Update KKDMP
    public function update(Request $request, Kkdmp $kkdmp)
    {
        $validated = $request->validate([
            'judul_dokumen' => 'required|string|max:200',
            'desa_id' => 'required|exists:desa,id',
            'tahun' => 'nullable|integer|min:2000|max:' . (date('Y') + 5),
            'deskripsi' => 'nullable|string',
            'file_url' => 'nullable|string|max:255',
            'status' => 'required|in:Draft,Published,Archived',
        ]);

        // Handle upload file baru (jika ada)
        if ($request->hasFile('file_upload')) {
            // Hapus file lama jika ada
            if ($kkdmp->file_url && file_exists(public_path($kkdmp->file_url))) {
                unlink(public_path($kkdmp->file_url));
            }

            $file = $request->file('file_upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/kkdmp'), $fileName);
            $validated['file_url'] = 'uploads/kkdmp/' . $fileName;
        }

        $kkdmp->update($validated);

        return redirect()->route('kkdmp.index')
            ->with('success', 'Dokumen KKDMP berhasil diupdate!');
    }

    // Hapus KKDMP
    public function destroy(Kkdmp $kkdmp)
    {
        // Hapus file jika ada
        if ($kkdmp->file_url && file_exists(public_path($kkdmp->file_url))) {
            unlink(public_path($kkdmp->file_url));
        }

        $kkdmp->delete();

        return redirect()->route('kkdmp.index')
            ->with('success', 'Dokumen KKDMP berhasil dihapus!');
    }
}