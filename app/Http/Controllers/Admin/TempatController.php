<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tempat;
use App\Models\Kategori;
use App\Models\KategoriField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TempatController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        return view('admin.tempat.index', compact('kategoris'));
    }

    public function showKategoriDetail($kategori)
    {
        $kategori = strtolower(trim($kategori));
        $kategoriModel = Kategori::where('nama', $kategori)->first();
        
        if (!$kategoriModel) {
            abort(404, 'Kategori tidak ditemukan');
        }

        $fields = $kategoriModel->fields;
        $data = Tempat::where('kategori', $kategori)->get();

        return view('admin.tempat.kategori-detail', compact('kategori', 'kategoriModel', 'fields', 'data'));
    }

    public function getKategoriFieldsJson($kategori)
    {
        $kategori = strtolower(trim($kategori));
        $kategoriModel = Kategori::where('nama', $kategori)->first();
        
        if (!$kategoriModel) {
            return response()->json(['success' => false, 'error' => 'Kategori tidak ditemukan'], 404);
        }

        $fields = $kategoriModel->fields;
        $data = Tempat::where('kategori', $kategori)->get();

        return response()->json([
            'success' => true,
            'kategori' => $kategori,
            'kategori_id' => $kategoriModel->id,
            'fields' => $fields,
            'data' => $data
        ]);
    }

    public function storeField(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_field' => 'required|string|max:100',
            'tipe_field' => 'required|in:text,number,textarea,file,date',
        ]);

        $maxUrutan = KategoriField::where('kategori_id', $validated['kategori_id'])->max('urutan') ?? 0;

        KategoriField::create([
            'kategori_id' => $validated['kategori_id'],
            'nama_field' => strtolower(trim($validated['nama_field'])),
            'tipe_field' => $validated['tipe_field'],
            'urutan' => $maxUrutan + 1,
        ]);

        return response()->json(['success' => true, 'message' => 'Field berhasil ditambahkan!']);
    }

    public function destroyField($id)
    {
        $field = KategoriField::findOrFail($id);
        $field->delete();

        return response()->json(['success' => true, 'message' => 'Field berhasil dihapus!']);
    }

    public function storeData(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|string',
            'nama' => 'required|string|max:255',
        ]);

        $kategori = strtolower(trim($validated['kategori']));
        $kategoriModel = Kategori::where('nama', $kategori)->first();

        if (!$kategoriModel) {
            return response()->json(['success' => false, 'message' => 'Kategori tidak ditemukan'], 404);
        }

        $fields = $kategoriModel->fields;
        $dataToSave = [
            'nama' => $validated['nama'],
            'kategori' => $kategori,
        ];

        $infoTambahan = [];
        foreach ($fields as $field) {
            $fieldName = $field->nama_field;
            
            if ($field->tipe_field === 'file' && $request->hasFile($fieldName)) {
                $infoTambahan[$fieldName] = $request->file($fieldName)->store('tempat', 'public');
            } elseif ($request->has($fieldName)) {
                $infoTambahan[$fieldName] = $request->input($fieldName);
            }
        }

        $dataToSave['info_tambahan'] = json_encode($infoTambahan);

        Tempat::create($dataToSave);

        return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan!']);
    }

    public function update(Request $request, $id)
    {
        $tempat = Tempat::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kategoriModel = Kategori::where('nama', $tempat->kategori)->first();
        
        if (!$kategoriModel) {
            return response()->json(['success' => false, 'message' => 'Kategori tidak ditemukan'], 404);
        }

        $fields = $kategoriModel->fields;
        
        $tempat->nama = $validated['nama'];
        
        $infoTambahan = is_string($tempat->info_tambahan) 
            ? (json_decode($tempat->info_tambahan, true) ?? []) 
            : (is_array($tempat->info_tambahan) ? $tempat->info_tambahan : []);
        
        foreach ($fields as $field) {
            $fieldName = $field->nama_field;
            
            if ($field->tipe_field === 'file' && $request->hasFile($fieldName)) {
                $oldFile = $infoTambahan[$fieldName] ?? null;
                if ($oldFile) {
                    Storage::disk('public')->delete($oldFile);
                }
                $infoTambahan[$fieldName] = $request->file($fieldName)->store('tempat', 'public');
            } elseif ($request->has($fieldName)) {
                $infoTambahan[$fieldName] = $request->input($fieldName);
            }
        }
        
        $tempat->info_tambahan = json_encode($infoTambahan);
        $tempat->save();

        return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui!']);
    }

    public function destroy($id)
    {
        $tempat = Tempat::findOrFail($id);
        
        $infoTambahan = $tempat->info_tambahan;
        
        if (is_string($infoTambahan)) {
            $infoTambahan = json_decode($infoTambahan, true) ?? [];
        } elseif (!is_array($infoTambahan)) {
            $infoTambahan = [];
        }
        
        foreach ($infoTambahan as $key => $value) {
            if (is_string($value) && !empty($value) && !str_starts_with($value, 'http')) {
                Storage::disk('public')->delete($value);
            }
        }
        
        if (!empty($tempat->foto)) {
            Storage::disk('public')->delete($tempat->foto);
        }
        
        $tempat->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus!']);
    }

    public function storeKategori(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:kategoris,nama',
        ]);

        Kategori::create([
            'nama' => strtolower(trim($validated['nama'])),
        ]);

        return response()->json([
            'success' => true, 
            'message' => 'Kategori berhasil ditambahkan!'
        ]);
    }

    public function updateKategori(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:kategoris,nama,' . $id,
        ]);

        $kategori->update([
            'nama' => strtolower(trim($validated['nama'])),
        ]);

        return response()->json(['success' => true, 'message' => 'Kategori berhasil diperbarui!']);
    }

    public function destroyKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return response()->json(['success' => true, 'message' => 'Kategori berhasil dihapus!']);
    }

    public function autocompleteKategori(Request $request)
    {
        $query = $request->get('q', '');
        $kategori = Tempat::select('kategori')
            ->distinct()
            ->where('kategori', 'like', '%' . $query . '%')
            ->pluck('kategori')
            ->filter()
            ->values();

        return response()->json($kategori);
    }
}