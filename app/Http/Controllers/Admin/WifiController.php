<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WifiController extends Controller
{
    public function index() { return view('admin.wifi.index'); }
    public function create() { return view('admin.wifi.create'); }
    public function store(Request $request) { return redirect()->route('admin.wifi.index')->with('success', 'Data berhasil disimpan!'); }
    public function show($id) { return view('admin.wifi.show'); }
    public function edit($id) { return view('admin.wifi.edit'); }
    public function update(Request $request, $id) { return redirect()->route('admin.wifi.index')->with('success', 'Data berhasil diupdate!'); }
    public function destroy($id) { return redirect()->route('admin.wifi.index')->with('success', 'Data berhasil dihapus!'); }
}