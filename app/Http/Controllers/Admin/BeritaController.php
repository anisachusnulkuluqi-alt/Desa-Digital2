<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // Sementara arahkan ke dashboard sampai view berita dibuat
    }

    public function create() { return view('admin.dashboard'); }
    public function store(Request $request) { return redirect()->route('admin.berita.index'); }
    public function show(string $id) { return view('admin.dashboard'); }
    public function edit(string $id) { return view('admin.dashboard'); }
    public function update(Request $request, string $id) { return redirect()->route('admin.berita.index'); }
    public function destroy(string $id) { return redirect()->route('admin.berita.index'); }
}