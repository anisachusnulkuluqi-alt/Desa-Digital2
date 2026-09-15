<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index() { return view('admin.wisata.index'); }
    public function create() { return view('admin.wisata.create'); }
    public function store(Request $request) { return redirect()->route('admin.wisata.index')->with('success', 'Data berhasil disimpan!'); }
    public function show($id) { return view('admin.wisata.show'); }
    public function edit($id) { return view('admin.wisata.edit'); }
    public function update(Request $request, $id) { return redirect()->route('admin.wisata.index')->with('success', 'Data berhasil diupdate!'); }
    public function destroy($id) { return redirect()->route('admin.wisata.index')->with('success', 'Data berhasil dihapus!'); }
}