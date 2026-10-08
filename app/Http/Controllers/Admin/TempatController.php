<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\KategoriField;
use App\Models\Tempat;
use App\Support\LokasiAttributeTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TempatController extends Controller
{
    /**
     * Tampilkan daftar kategori/atribut (Master)
     */
    public function index(Request $request)
    {
        $kategoris = Kategori::orderBy('nama', 'asc')->get();
        
        foreach ($kategoris as $kategori) {
            LokasiAttributeTable::ensureCategoryFields($kategori);
        }

        return view('admin.tempat.index', compact('kategoris'));
    }

    /**
     * Tampilkan halaman detail kategori dengan field dinamis
     */
    public function showKategoriDetail($kategori)
    {
        $kategori = strtolower(trim($kategori));
        $kategoriModel = Kategori::where('nama', $kategori)->first();

        if (!$kategoriModel) {
            abort(404, 'Kategori tidak ditemukan');
        }

        LokasiAttributeTable::ensureCategoryFields($kategoriModel);
        $fields = $kategoriModel->fields;
        $data = Tempat::where('kategori', $kategori)->get();

        return view('admin.tempat.kategori-detail', compact('kategori', 'kategoriModel', 'fields', 'data'));
    }

    /**
     * Ambil data field kategori dalam format JSON (untuk popup)
     */
    public function getKategoriFieldsJson($kategori)
    {
        $kategori = strtolower(trim($kategori));
        $kategoriModel = Kategori::where('nama', $kategori)->first();

        if (!$kategoriModel) {
            return response()->json(['success' => false, 'error' => 'Kategori tidak ditemukan'], 404);
        }

        LokasiAttributeTable::ensureCategoryFields($kategoriModel);
        $fields = $kategoriModel->fields;
        $data = Tempat::where('kategori', $kategori)->get();

        return response()->json([
            'success' => true,
            'kategori' => $kategori,
            'kategori_id' => $kategoriModel->id,
            'fields' => $fields,
            'data' => $data,
        ]);
    }

    /**
     * Tambah field baru ke kategori
     */
    public function storeField(Request $request)
    {
        $request->merge([
            'nama_field' => strtolower(trim((string) $request->input('nama_field'))),
        ]);

        $validated = $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_field' => [
                'required',
                'string',
                'max:100',
                'regex:/^[a-z][a-z0-9_]*$/',
                'not_in:id,nama,tempat_id,created_at,updated_at',
                'unique:kategori_fields,nama_field,NULL,id,kategori_id,' . $request->input('kategori_id'),
            ],
            'tipe_field' => 'required|in:text,number,textarea,file,date',
        ]);

        $maxUrutan = KategoriField::where('kategori_id', $validated['kategori_id'])->max('urutan') ?? 0;

        $field = new KategoriField([
            'kategori_id' => $validated['kategori_id'],
            'nama_field' => $validated['nama_field'],
            'tipe_field' => $validated['tipe_field'],
            'urutan' => $maxUrutan + 1,
        ]);
        $field->save();
        
        foreach ($field->kategori->fields as $categoryField) {
            LokasiAttributeTable::create($categoryField);
        }

        return response()->json([
            'success' => true,
            'table' => LokasiAttributeTable::name($field),
            'message' => 'Field berhasil ditambahkan!',
        ]);
    }

    /**
     * Hapus field dari kategori
     */
    public function destroyField($id)
    {
        $field = KategoriField::findOrFail($id);
        LokasiAttributeTable::delete($field);
        $field->delete();

        return response()->json(['success' => true, 'message' => 'Field berhasil dihapus!']);
    }

    /**
     * Simpan data dengan field dinamis (TAMBAH BARU)
     */
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

        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'foto' => 'nullable|image|max:5120',
        ]);

        LokasiAttributeTable::ensureCategoryFields($kategoriModel);
        $fields = $kategoriModel->fields;
        
        $dataToSave = [
            'nama' => $validated['nama'],
            'kategori' => $kategori,
        ];

        $infoTambahan = [];
        foreach ($fields as $field) {
            $fieldName = $field->nama_field;

            if ($fieldName === 'foto' && $request->hasFile($fieldName)) {
                $infoTambahan[$fieldName] = $request->file($fieldName)->store('tempat', 'public');
            } elseif ($field->tipe_field === 'file' && $request->hasFile($fieldName)) {
                $infoTambahan[$fieldName] = $request->file($fieldName)->store('tempat', 'public');
            } elseif ($request->has($fieldName)) {
                $infoTambahan[$fieldName] = $request->input($fieldName);
            }
        }

        $dataToSave['info_tambahan'] = json_encode($infoTambahan);

        $tempat = Tempat::create($dataToSave);
        
        foreach ($fields as $field) {
            if (array_key_exists($field->nama_field, $infoTambahan)) {
                LokasiAttributeTable::save($field, $tempat->id, $infoTambahan[$field->nama_field]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan!']);
    }

    /**
     * Update data tempat dengan field dinamis
     */
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

        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'foto' => 'nullable|image|max:5120',
        ]);

        LokasiAttributeTable::ensureCategoryFields($kategoriModel);
        $fields = $kategoriModel->fields;

        $tempat->nama = $validated['nama'];

        $infoTambahan = is_string($tempat->info_tambahan)
            ? (json_decode($tempat->info_tambahan, true) ?? [])
            : (is_array($tempat->info_tambahan) ? $tempat->info_tambahan : []);

        foreach ($fields as $field) {
            $fieldName = $field->nama_field;

            if ($fieldName === 'foto' && $request->hasFile($fieldName)) {
                $oldFile = $infoTambahan[$fieldName] ?? null;
                if ($oldFile) {
                    Storage::disk('public')->delete($oldFile);
                }
                $infoTambahan[$fieldName] = $request->file($fieldName)->store('tempat', 'public');
            } elseif ($field->tipe_field === 'file' && $request->hasFile($fieldName)) {
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

        foreach ($fields as $field) {
            if (array_key_exists($field->nama_field, $infoTambahan)) {
                LokasiAttributeTable::save($field, $tempat->id, $infoTambahan[$field->nama_field]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui!']);
    }

    /**
     * Hapus data tempat
     */
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

        LokasiAttributeTable::deleteTempatValues($tempat);

        if (!empty($tempat->foto)) {
            Storage::disk('public')->delete($tempat->foto);
        }

        $tempat->delete();

        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus!']);
    }

    /**
     * Simpan kategori/atribut baru
     */
    public function storeKategori(Request $request)
    {
        $request->merge(['nama' => strtolower(trim((string) $request->input('nama')))]);
        
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:kategoris,nama',
        ]);

        $kategori = Kategori::create([
            'nama' => $validated['nama'],
        ]);
        
        LokasiAttributeTable::ensureCategoryFields($kategori);

        return response()->json([
            'success' => true,
            'table' => LokasiAttributeTable::nameForCategory($kategori->nama, $kategori->id),
            'message' => 'Kategori berhasil ditambahkan!',
        ]);
    }

    /**
     * Update kategori/atribut
     */
    public function updateKategori(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        LokasiAttributeTable::ensureCategoryFields($kategori);
        
        $request->merge(['nama' => strtolower(trim((string) $request->input('nama')))]);
        
        $validated = $request->validate([
            'nama' => 'required|string|max:100|unique:kategoris,nama,' . $id,
        ]);

        $nama = $validated['nama'];
        
        LokasiAttributeTable::renameCategoryTables($kategori->fields, $nama);
        Tempat::where('kategori', $kategori->nama)->update(['kategori' => $nama]);
        
        $kategori->update([
            'nama' => $nama,
        ]);

        return response()->json(['success' => true, 'message' => 'Kategori berhasil diperbarui!']);
    }

    /**
     * Hapus kategori/atribut + semua data tempat di dalamnya
     */
    public function destroyKategori($id)
    {
        $kategori = Kategori::findOrFail($id);
        $namaKategori = $kategori->nama;
        
        // Hapus semua data tempat dengan kategori ini
        $tempats = Tempat::where('kategori', $namaKategori)->get();
        
        foreach ($tempats as $tempat) {
            // Hapus file-file dari info_tambahan
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
            
            // Hapus foto standar jika ada
            if (!empty($tempat->foto)) {
                Storage::disk('public')->delete($tempat->foto);
            }
            
            LokasiAttributeTable::deleteTempatValues($tempat);
            $tempat->delete();
        }
        
        // Hapus semua field yang terkait dengan kategori ini
        KategoriField::where('kategori_id', $id)->delete();
        
        // Hapus tabel atribut lokasi
        LokasiAttributeTable::deleteCategoryTables($kategori);
        
        // Hapus kategori
        $kategori->delete();

        return response()->json([
            'success' => true, 
            'message' => 'Kategori "' . ucfirst($namaKategori) . '" dan semua datanya berhasil dihapus!'
        ]);
    }

    /**
     * Autocomplete kategori
     */
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