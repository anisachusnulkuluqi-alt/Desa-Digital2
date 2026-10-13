<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::orderBy('id')->get();

        return view('admin.layanan.index', compact('layanans'));
    }

    public function store(Request $request)
    {
        Layanan::create($this->validatedData($request));

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function update(Request $request, Layanan $layanan)
    {
        $layanan->update($this->validatedData($request));

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nama' => ['required', 'string', 'max:120'],
            'link' => [
                'required',
                'string',
                'max:2048',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    $isRelativePath = is_string($value)
                        && str_starts_with($value, '/')
                        && !str_starts_with($value, '//')
                        && !str_contains($value, '\\')
                        && !preg_match('/[\x00-\x20]/', $value);
                    $scheme = is_string($value) ? parse_url($value, PHP_URL_SCHEME) : null;
                    $isHttpUrl = is_string($value)
                        && filter_var($value, FILTER_VALIDATE_URL)
                        && in_array($scheme, ['http', 'https'], true);

                    if (!$isRelativePath && !$isHttpUrl) {
                        $fail('Link harus berupa URL HTTP/HTTPS atau path internal seperti /website.');
                    }
                },
            ],
        ]);
    }
}
