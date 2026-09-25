<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WifiDesa;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WifiController extends Controller
{
    public function index()
    {
        $wifis = WifiDesa::with('desa')->orderBy('nama_ssid', 'asc')->get();
        $totalWifi = WifiDesa::count();
        $totalDesa = Desa::count();

        return view('admin.wifi.index', compact('wifis', 'totalWifi', 'totalDesa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'desa_id' => 'nullable|exists:desa,id',
            'nama_ssid' => 'required|string|max:255',
            'fasilitator' => 'nullable|in:Pemerintah Desa,Pemerintah Kabupaten',
            'alamat' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('wifi', 'public');
        }

        WifiDesa::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Data WiFi berhasil ditambahkan!'
        ]);
    }

    public function update(Request $request, WifiDesa $wifi)
    {
        $request->validate([
            'desa_id' => 'nullable|exists:desa,id',
            'nama_ssid' => 'required|string|max:255',
            'fasilitator' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except('foto');
        
        if ($request->hasFile('foto')) {
            if ($wifi->foto) {
                Storage::disk('public')->delete($wifi->foto);
            }
            $data['foto'] = $request->file('foto')->store('wifi', 'public');
        }

        $wifi->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data WiFi berhasil diperbarui!'
        ]);
    }

    public function destroy(WifiDesa $wifi)
    {
        if ($wifi->foto) {
            Storage::disk('public')->delete($wifi->foto);
        }
        
        $wifi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data WiFi berhasil dihapus!'
        ]);
    }
}