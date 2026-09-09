<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function index(Request $request)
    {
        $query = Desa::query();

        // Fitur Pencarian Nama Desa
        if ($request->filled('search')) {
            $query->where('nama_desa', 'like', '%' . $request->search . '%');
        }

        // Fitur Filter per Kecamatan
        if ($request->filled('kecamatan') && $request->kecamatan != 'Semua') {
            $query->where('kecamatan', $request->kecamatan);
        }

        $desas = $query->orderBy('nama_desa', 'asc')->get();

        // Daftar Kecamatan di Kabupaten Tuban untuk tombol filter
        $kecamatanList = [
            'Bancar', 'Bangilan', 'Grabagan', 'Jatirogo', 'Jenu', 
            'Kenduruan', 'Kerek', 'Merakurak', 'Montong', 'Palang', 
            'Parengan', 'Plumpang', 'Rengel', 'Semanding', 'Senori', 
            'Singgahan', 'Soko', 'Tambakboyo', 'Tuban', 'Widang'
        ];

        return view('desa.index', compact('desas', 'kecamatanList'));
    }

    public function create()
    {
        return view('desa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'populasi' => 'required|numeric',
            'luas_wilayah' => 'nullable|string',
            'url_website' => 'nullable|url',
        ]);

        Desa::create($request->all());

        return redirect()->route('desa.index')->with('success', 'Data desa berhasil ditambahkan!');
    }
}