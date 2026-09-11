<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KecamatanController extends Controller
{
    /**
     * Tampilkan daftar kecamatan dengan statistik
     */
    public function index(Request $request)
    {
        // Query dengan relasi desa dan hitung jumlah desa
        $query = Kecamatan::withCount('desas');
        
        // Search berdasarkan nama kecamatan
        if ($request->has('search') && $request->search) {
            $query->where('nama_kecamatan', 'like', '%' . $request->search . '%');
        }
        
        // Filter berdasarkan kabupaten
        if ($request->has('kabupaten') && $request->kabupaten) {
            $query->where('kabupaten', $request->kabupaten);
        }
        
        // Pagination
        $kecamatans = $query->orderBy('nama_kecamatan')->paginate(10);
        
        // Statistik
        $totalKecamatan = Kecamatan::count();
        $totalDesa = Desa::count();
        $avgDesa = $totalKecamatan > 0 ? round($totalDesa / $totalKecamatan, 1) : 0;
        
        // Data untuk chart
        $chartLabels = Kecamatan::orderBy('nama_kecamatan')->pluck('nama_kecamatan');
        $chartData = Kecamatan::withCount('desas')->orderBy('nama_kecamatan')->get()->pluck('desas_count');
        
        return view('admin.kecamatan.index', compact(
            'kecamatans',
            'totalKecamatan',
            'totalDesa',
            'avgDesa',
            'chartLabels',
            'chartData'
        ));
    }

    /**
     * Tampilkan form tambah kecamatan
     */
    public function create()
    {
        return view('admin.kecamatan.create');
    }

    /**
     * Simpan kecamatan baru ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_kecamatan' => 'required|string|max:100',
            'kode_wilayah' => 'nullable|string|max:20|unique:kecamatan,kode_wilayah',
            'kabupaten' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
            'jumlah_desa' => 'nullable|integer|min:0',
        ]);

        // Generate slug otomatis
        $validated['slug'] = Str::slug($validated['nama_kecamatan']) . '-' . time();
        
        // Set default kabupaten jika kosong
        if (!isset($validated['kabupaten']) || empty($validated['kabupaten'])) {
            $validated['kabupaten'] = 'Tuban';
        }

        // Simpan ke database
        Kecamatan::create($validated);

        return redirect()->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail kecamatan
     */
    public function show($id)
    {
        $kecamatan = Kecamatan::with('desas')->findOrFail($id);
        return view('admin.kecamatan.show', compact('kecamatan'));
    }

    /**
     * Tampilkan form edit kecamatan
     */
    public function edit($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        return view('admin.kecamatan.edit', compact('kecamatan'));
    }

    /**
     * Update kecamatan di database
     */
    public function update(Request $request, $id)
    {
        $kecamatan = Kecamatan::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'nama_kecamatan' => 'required|string|max:100',
            'kode_wilayah' => 'nullable|string|max:20|unique:kecamatan,kode_wilayah,' . $id,
            'kabupaten' => 'nullable|string|max:100',
            'deskripsi' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'alamat' => 'nullable|string',
            'jumlah_desa' => 'nullable|integer|min:0',
        ]);

        // Update slug jika nama berubah
        if ($kecamatan->nama_kecamatan !== $validated['nama_kecamatan']) {
            $validated['slug'] = Str::slug($validated['nama_kecamatan']) . '-' . time();
        }

        // Update data
        $kecamatan->update($validated);

        return redirect()->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil diupdate!');
    }

    /**
     * Hapus kecamatan dari database
     */
    public function destroy($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        
        // Cek apakah masih ada desa yang menggunakan kecamatan ini
        if ($kecamatan->desas()->count() > 0) {
            return redirect()->route('admin.kecamatan.index')
                ->with('error', 'Kecamatan tidak dapat dihapus karena masih memiliki ' . $kecamatan->desas()->count() . ' desa.');
        }
        
        // Hapus data
        $kecamatan->delete();

        return redirect()->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil dihapus!');
    }

    /**
     * Export data kecamatan (JSON)
     */
    public function export(Request $request)
    {
        $kecamatans = Kecamatan::withCount('desas')
            ->orderBy('nama_kecamatan')
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $kecamatans,
            'total' => $kecamatans->count(),
            'exported_at' => now()->toDateTimeString()
        ]);
    }

    /**
     * Get statistik kecamatan (JSON)
     */
    public function statistik()
    {
        $totalKecamatan = Kecamatan::count();
        $totalDesa = Desa::count();
        $kecamatanDenganDesa = Kecamatan::has('desas')->count();
        $kecamatanTanpaDesa = Kecamatan::doesntHave('desas')->count();
        $rataRataDesa = $totalKecamatan > 0 ? round($totalDesa / $totalKecamatan, 2) : 0;
        
        // Top 5 kecamatan dengan desa terbanyak
        $topKecamatan = Kecamatan::withCount('desas')
            ->orderBy('desas_count', 'desc')
            ->take(5)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => [
                'total_kecamatan' => $totalKecamatan,
                'total_desa' => $totalDesa,
                'kecamatan_dengan_desa' => $kecamatanDenganDesa,
                'kecamatan_tanpa_desa' => $kecamatanTanpaDesa,
                'rata_rata_desa_per_kecamatan' => $rataRataDesa,
                'top_5_kecamatan' => $topKecamatan
            ]
        ]);
    }

    /**
     * Cari kecamatan (untuk autocomplete/search)
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        $kecamatans = Kecamatan::where('nama_kecamatan', 'like', '%' . $query . '%')
            ->orWhere('kode_wilayah', 'like', '%' . $query . '%')
            ->limit(10)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $kecamatans
        ]);
    }
}