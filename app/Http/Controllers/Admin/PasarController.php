<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasarController extends Controller
{
    public function index() { return view('admin.pasar.index'); }
    public function create() { return view('admin.pasar.create'); }
    public function store(Request $request) { return redirect()->route('admin.pasar.index')->with('success', 'Data berhasil disimpan!'); }
    public function show($id) { return view('admin.pasar.show'); }
    public function edit($id) { return view('admin.pasar.edit'); }
    public function update(Request $request, $id) { return redirect()->route('admin.pasar.index')->with('success', 'Data berhasil diupdate!'); }
    public function destroy($id) { return redirect()->route('admin.pasar.index')->with('success', 'Data berhasil dihapus!'); }
}