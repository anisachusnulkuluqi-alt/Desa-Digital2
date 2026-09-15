<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KkdmpController extends Controller
{
    public function index() { return view('admin.kkdmp.index'); }
    public function create() { return view('admin.kkdmp.create'); }
    public function store(Request $request) { return redirect()->route('admin.kkdmp.index')->with('success', 'Data berhasil disimpan!'); }
    public function show($id) { return view('admin.kkdmp.show'); }
    public function edit($id) { return view('admin.kkdmp.edit'); }
    public function update(Request $request, $id) { return redirect()->route('admin.kkdmp.index')->with('success', 'Data berhasil diupdate!'); }
    public function destroy($id) { return redirect()->route('admin.kkdmp.index')->with('success', 'Data berhasil dihapus!'); }
}