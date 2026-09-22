<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Imports\DesaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;

class DesaController extends Controller
{
    public function index(Request $request)
    {
        $query = Desa::with('kecamatan');
        
        // Filter berdasarkan kecamatan
        if ($request->filled('kecamatan_id')) {
            $query->where('kecamatan_id', $request->kecamatan_id);
        }
        
        // Filter pencarian
        if ($request->filled('search')) {
            $query->where('nama_desa', 'like', '%' . $request->search . '%');
        }
        
        $desas = $query->orderBy('nama_desa', 'asc')->get();
        $totalDesa = Desa::count();
        $totalKecamatan = Kecamatan::count();
        $selectedKecamatan = $request->kecamatan_id ? Kecamatan::find($request->kecamatan_id) : null;

        return view('admin.desa.index', compact('desas', 'totalDesa', 'totalKecamatan', 'selectedKecamatan'));
    }

    public function create()
    {
        $kecamatans = Kecamatan::orderBy('nama_kecamatan', 'asc')->get();
        return view('admin.desa.create', compact('kecamatans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_desa' => 'required|string|max:255|unique:desa,nama_desa',
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kode_desa' => 'nullable|string|max:20',
            'jenis' => 'required|in:Desa,Kelurahan',
            'website' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'whatsapp_url' => 'nullable|url|max:255',
        ]);

        $desa = Desa::create($request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Desa berhasil ditambahkan!',
                'data' => $desa
            ]);
        }

        return redirect()->route('admin.desa.index')->with('success', 'Desa berhasil ditambahkan!');
    }

    public function show(Desa $desa)
    {
        return $this->showDetail($desa);
    }

    public function showDetail(Desa $desa)
    {
        $desa->load('kecamatan');
        return view('admin.desa.detail', compact('desa'));
    }

    public function edit(Desa $desa)
    {
        $kecamatans = Kecamatan::orderBy('nama_kecamatan', 'asc')->get();
        return view('admin.desa.edit', compact('desa', 'kecamatans'));
    }

    public function update(Request $request, Desa $desa)
    {
        $request->validate([
            'nama_desa' => 'required|string|max:255|unique:desa,nama_desa,' . $desa->id,
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'kode_desa' => 'nullable|string|max:20',
            'jenis' => 'required|in:Desa,Kelurahan',
            'website' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'whatsapp_url' => 'nullable|url|max:255',
        ]);

        $desa->update($request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Desa berhasil diperbarui!',
                'data' => $desa
            ]);
        }

        return redirect()->route('admin.desa.index')->with('success', 'Desa berhasil diperbarui!');
    }

    public function destroy(Desa $desa)
    {
        $desa->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Desa berhasil dihapus!'
            ]);
        }

        return redirect()->route('admin.desa.index')->with('success', 'Desa berhasil dihapus!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            Excel::import(new DesaImport, $request->file('file_excel'));

            $stats = session('import_stats', [
                'inserted' => 0,
                'skipped' => 0,
                'errors' => [],
            ]);

            $desaCount = Desa::count();

            $message = "Import selesai! ";
            $message .= "Data masuk: {$stats['inserted']}, ";
            $message .= "Dilewati: {$stats['skipped']}. ";
            $message .= "Total Desa sekarang: {$desaCount}.";

            if (!empty($stats['errors'])) {
                $message .= "\n\nError: " . implode("; ", array_slice($stats['errors'], 0, 5));
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => $message]);
            }

            return redirect()->route('admin.desa.index')->with('success', $message);
            
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = "Baris " . $failure->row() . ": " . implode(', ', $failure->errors());
            }
            return redirect()->route('admin.desa.index')->with('error', 'Validasi gagal: ' . implode('; ', $errors));
            
        } catch (\Exception $e) {
            \Log::error("Import Desa Error: " . $e->getMessage());
            return redirect()->route('admin.desa.index')->with('error', 'Import gagal: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $data = [
            ['NAMA KECAMATAN', 'NAMA DESA', 'KODE DESA', 'JENIS'],
            ['Bancar', 'Bancar', '3523010001', 'Desa'],
            ['Bancar', 'Bogorejo', '3523010002', 'Desa'],
            ['Kenduruan', 'Jlodro', '3523012001', 'Desa'],
        ];

        return Excel::download(new FromArray($data), 'template_import_desa.xlsx');
    }
}