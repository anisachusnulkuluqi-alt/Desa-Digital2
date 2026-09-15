<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BumdesController extends Controller
{
    public function index() { return view('admin.bumdes.index'); }
    public function create() { return view('admin.bumdes.create'); }
    public function store(Request $request) { return redirect()->route('admin.bumdes.index')->with('success', 'Data berhasil disimpan!'); }
    public function show($id) { return view('admin.bumdes.show'); }
    public function edit($id) { return view('admin.bumdes.edit'); }
    public function update(Request $request, $id) { return redirect()->route('admin.bumdes.index')->with('success', 'Data berhasil diupdate!'); }
    public function destroy($id) { return redirect()->route('admin.bumdes.index')->with('success', 'Data berhasil dihapus!'); }
}