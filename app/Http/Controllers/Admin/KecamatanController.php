<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Imports\DesaKecamatanImport; // <-- PASTIKAN INI BENAR
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;

class KecamatanController extends Controller
{
    public function index()
    {
        $kecamatans = Kecamatan::withCount('desas')->orderBy('nama_kecamatan', 'asc')->get();
        $totalKecamatan = Kecamatan::count();

        return view('admin.kecamatan.index', compact('kecamatans', 'totalKecamatan'));
    }

    public function show(Kecamatan $kecamatan)
    {
        $kecamatan->load('desas');
        $totalDesa = $kecamatan->desas->count();
        
        return view('admin.kecamatan.show', compact('kecamatan', 'totalDesa'));
    }

    public function create()
    {
        return view('admin.kecamatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kecamatan' => 'required|string|max:255|unique:kecamatan,nama_kecamatan',
        ]);

        $kecamatan = Kecamatan::create([
            'nama_kecamatan' => $request->nama_kecamatan,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kecamatan berhasil ditambahkan!',
                'data' => $kecamatan
            ]);
        }

        return redirect()->route('admin.kecamatan.index')->with('success', 'Kecamatan berhasil ditambahkan!');
    }

    public function edit(Kecamatan $kecamatan)
    {
        return view('admin.kecamatan.edit', compact('kecamatan'));
    }

    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'nama_kecamatan' => 'required|string|max:255|unique:kecamatan,nama_kecamatan,' . $kecamatan->id,
        ]);

        $kecamatan->update([
            'nama_kecamatan' => $request->nama_kecamatan,
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kecamatan berhasil diperbarui!',
                'data' => $kecamatan
            ]);
        }

        return redirect()->route('admin.kecamatan.index')->with('success', 'Kecamatan berhasil diperbarui!');
    }

    public function destroy(Kecamatan $kecamatan)
    {
        if ($kecamatan->desas()->count() > 0) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kecamatan tidak dapat dihapus karena masih memiliki ' . $kecamatan->desas()->count() . ' desa.'
                ], 422);
            }
            return redirect()->route('admin.kecamatan.index')->with('error', 'Kecamatan tidak dapat dihapus karena masih memiliki desa.');
        }

        $kecamatan->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kecamatan berhasil dihapus!'
            ]);
        }

        return redirect()->route('admin.kecamatan.index')->with('success', 'Kecamatan berhasil dihapus!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:10240',
        ]);

        try {
            // <-- PANGGIL CLASS YANG BENAR DI SINI
            Excel::import(new DesaKecamatanImport, $request->file('file_excel'));

            $kecamatanCount = Kecamatan::count();
            $desaCount = Desa::count();

            $message = "Import berhasil! Total Kecamatan: {$kecamatanCount}, Total Desa: {$desaCount}.";

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => $message]);
            }

            return redirect()->route('admin.kecamatan.index')->with('success', $message);
            
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errors = [];
            foreach ($failures as $failure) {
                $errors[] = "Baris " . $failure->row() . ": " . implode(', ', $failure->errors());
            }
            return redirect()->route('admin.kecamatan.index')->with('error', 'Validasi gagal: ' . implode('; ', $errors));
            
        } catch (\Exception $e) {
            \Log::error("Import Excel Error: " . $e->getMessage());
            return redirect()->route('admin.kecamatan.index')->with('error', 'Import gagal: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $data = [
            ['NAMA KECAMATAN', 'DESA', 'KODE'],
            ['Kenduruan', 'Jlodro', '3523012001'],
            ['Kenduruan', 'Sokogunung', '3523012002'],
            ['Jatirogo', 'Kebonharjo', '3523022001'],
        ];

        return Excel::download(new FromArray($data), 'template_import_kecamatan_desa.xlsx');
    }
}