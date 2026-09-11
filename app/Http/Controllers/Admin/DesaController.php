<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DesaController extends Controller
{
    /**
     * Tampilkan daftar desa dengan statistik
     */
    public function index(Request $request)
    {
        // Query dengan relasi kecamatan
        $query = Desa::with('kecamatan');
        
        // Search berdasarkan nama desa
        if ($request->has('search') && $request->search) {
            $query->where('nama_desa', 'like', '%' . $request->search . '%');
        }
        
        // Filter berdasarkan kecamatan_id
        if ($request->has('kecamatan_id') && $request->kecamatan_id) {
            $query->where('kecamatan_id', $request->kecamatan_id);
        }
        
        // Filter berdasarkan status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        
        $desas = $query->orderBy('nama_desa')->paginate(5);
        
        // Ambil semua kecamatan untuk filter dropdown
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();
        
        // ============================================
        // STATISTIK - WAJIB ADA UNTUK VIEW
        // ============================================
        $totalDesa = Desa::count();
        $totalPenduduk = Desa::sum('jumlah_penduduk') ?? 0;
        $totalKK = Desa::sum('jumlah_kk') ?? 0;
        
        // Hitung desa per status
        $desaMaju = Desa::where('status', 'maju')->count();
        $desaBerkembang = Desa::where('status', 'berkembang')->count();
        $desaMandiri = Desa::where('status', 'mandiri')->count();
        $desaAktif = Desa::where('status', 'aktif')->count();
        
        // Data chart pertumbuhan desa (5 tahun terakhir)
        $chartLabels = ['2020', '2021', '2022', '2023', '2024'];
        $chartData = [45, 58, 72, 84, $totalDesa];
        
        // Kirim SEMUA variabel ke view
        return view('admin.desa.index', compact(
            'desas',
            'kecamatans',
            'totalDesa',
            'totalPenduduk',
            'totalKK',
            'desaMaju',
            'desaBerkembang',
            'desaMandiri',
            'desaAktif',
            'chartLabels',
            'chartData'
        ));
    }

    /**
     * Tampilkan form tambah desa
     */
    public function create()
    {
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();
        return view('admin.desa.create', compact('kecamatans'));
    }

    /**
     * Simpan desa baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_desa' => 'required|string|max:100',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kode_desa' => 'required|string|max:20|unique:desa,kode_desa',
            'luas_wilayah' => 'nullable|numeric|min:0',
            'jumlah_penduduk' => 'nullable|integer|min:0',
            'jumlah_kk' => 'nullable|integer|min:0',
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'alamat_kantor' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'foto_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'nullable|in:maju,berkembang,mandiri,aktif',
        ]);

        // Generate slug otomatis
        $validated['slug'] = Str::slug($validated['nama_desa']) . '-' . time();
        
        // Set default status jika tidak diisi
        if (!isset($validated['status'])) {
            $validated['status'] = 'aktif';
        }

        // Upload foto jika ada
        if ($request->hasFile('foto_url')) {
            $validated['foto_url'] = $request->file('foto_url')->store('desa', 'public');
        }

        // Simpan ke database
        Desa::create($validated);

        return redirect()->route('admin.desa.index')
            ->with('success', 'Desa berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail desa
     */
    public function show($id)
    {
        $desa = Desa::with('kecamatan')->findOrFail($id);
        return view('admin.desa.show', compact('desa'));
    }

    /**
     * Tampilkan form edit desa
     */
    public function edit($id)
    {
        $desa = Desa::findOrFail($id);
        $kecamatans = Kecamatan::orderBy('nama_kecamatan')->get();
        return view('admin.desa.edit', compact('desa', 'kecamatans'));
    }

    /**
     * Update desa di database
     */
    public function update(Request $request, $id)
    {
        $desa = Desa::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama_desa' => 'required|string|max:100',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kode_desa' => 'required|string|max:20|unique:desa,kode_desa,' . $id,
            'luas_wilayah' => 'nullable|numeric|min:0',
            'jumlah_penduduk' => 'nullable|integer|min:0',
            'jumlah_kk' => 'nullable|integer|min:0',
            'sejarah' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'alamat_kantor' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'foto_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'nullable|in:maju,berkembang,mandiri,aktif',
        ]);

        // Update slug jika nama berubah
        if ($desa->nama_desa !== $validated['nama_desa']) {
            $validated['slug'] = Str::slug($validated['nama_desa']) . '-' . time();
        }

        // Upload foto baru jika ada
        if ($request->hasFile('foto_url')) {
            // Hapus foto lama
            if ($desa->foto_url) {
                Storage::disk('public')->delete($desa->foto_url);
            }
            // Simpan foto baru
            $validated['foto_url'] = $request->file('foto_url')->store('desa', 'public');
        }

        // Update data
        $desa->update($validated);

        return redirect()->route('admin.desa.index')
            ->with('success', 'Desa berhasil diupdate!');
    }

    /**
     * Hapus desa dari database
     */
    public function destroy($id)
    {
        $desa = Desa::findOrFail($id);

        // Hapus foto jika ada
        if ($desa->foto_url) {
            Storage::disk('public')->delete($desa->foto_url);
        }

        // Hapus data
        $desa->delete();

        return redirect()->route('admin.desa.index')
            ->with('success', 'Desa berhasil dihapus!');
    }

    /**
     * Download laporan desa (opsional)
     */
    public function download(Request $request)
    {
        $desas = Desa::with('kecamatan')->orderBy('nama_desa')->get();
        
        // Bisa dikembangkan untuk export CSV/Excel/PDF
        // Untuk sementara, return JSON sebagai contoh
        return response()->json($desas);
    }
}