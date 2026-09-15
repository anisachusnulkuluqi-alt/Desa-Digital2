<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KantorDesaController extends Controller
{
    public function index() { return view('admin.kantor-desa.index'); }
    public function create() { return view('admin.kantor-desa.create'); }
    public function store(Request $request) { return redirect()->route('admin.kantor-desa.index')->with('success', 'Data berhasil disimpan!'); }
    public function show($id) { return view('admin.kantor-desa.show'); }
    public function edit($id) { return view('admin.kantor-desa.edit'); }
    public function update(Request $request, $id) { return redirect()->route('admin.kantor-desa.index')->with('success', 'Data berhasil diupdate!'); }
    public function destroy($id) { return redirect()->route('admin.kantor-desa.index')->with('success', 'Data berhasil dihapus!'); }
}