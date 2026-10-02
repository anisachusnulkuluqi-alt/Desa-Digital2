<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        return view('landing');
    }

    public function tentang()
    {
        return view('tentang');
    }

    public function kontak()
    {
        return view('kontak');
    }

    public function suggestions(Request $request)
    {
        $term = trim($request->string('q')->toString());

        if ($term === '' || mb_strlen($term) > 80) {
            return response()->json([]);
        }

        $prefix = Str::lower($term);
        $like = $term.'%';
        $pageSuggestions = collect([
            [
                'title' => 'Pelayanan Publik Digital',
                'type' => 'Layanan',
                'description' => 'Surat desa, CCTV, dan e-PBB.',
                'url' => url('/#layanan-digital'),
            ],
            [
                'title' => 'Peta Data Spasial',
                'type' => 'Layanan',
                'description' => 'Peta desa, kecamatan, wisata, dan fasilitas umum.',
                'url' => url('/data-spasial'),
            ],
            [
                'title' => 'Pasar Desa',
                'type' => 'Data',
                'description' => 'Lokasi pasar desa di Kabupaten Tuban.',
                'url' => url('/data-spasial?filter=pasar'),
            ],
            [
                'title' => 'Profil Desa Digital',
                'type' => 'Informasi',
                'description' => 'Tentang platform dan inovasi desa digital.',
                'url' => url('/#tentang-kami'),
            ],
            [
                'title' => 'Surat Desa',
                'type' => 'Layanan',
                'description' => 'Layanan administrasi persuratan.',
                'url' => url('/surat'),
            ],
            [
                'title' => 'Wisata Desa',
                'type' => 'Data',
                'description' => 'Daftar lokasi wisata di Kabupaten Tuban.',
                'url' => url('/data-spasial?filter=wisata'),
            ],
            [
                'title' => 'Website Desa',
                'type' => 'Layanan',
                'description' => 'Direktori website desa dan kelurahan.',
                'url' => url('/website'),
            ],
            [
                'title' => 'Hubungi Kami',
                'type' => 'Informasi',
                'description' => 'Alamat, telepon, dan email Diskominfo Tuban.',
                'url' => url('/#hubungi-kami'),
            ],
        ])->filter(fn (array $item): bool => Str::startsWith(Str::lower($item['title']), $prefix));

        $villageSuggestions = Desa::query()
            ->with('kecamatan')
            ->where('nama_desa', 'like', $like)
            ->orderBy('nama_desa')
            ->limit(4)
            ->get()
            ->map(fn (Desa $desa): array => [
                'title' => $desa->nama_desa,
                'type' => 'Desa',
                'description' => 'Kecamatan '.($desa->kecamatan?->nama_kecamatan ?? 'belum tercatat'),
                'url' => url('/data-spasial?'.http_build_query([
                    'search' => $desa->nama_desa,
                    'layer' => 'desa',
                ])),
            ]);

        $districtSuggestions = Kecamatan::query()
            ->where('nama_kecamatan', 'like', $like)
            ->orderBy('nama_kecamatan')
            ->limit(4)
            ->get()
            ->map(fn (Kecamatan $kecamatan): array => [
                'title' => $kecamatan->nama_kecamatan,
                'type' => 'Kecamatan',
                'description' => 'Data kecamatan dan desa di Kabupaten Tuban.',
                'url' => url('/data-spasial?'.http_build_query([
                    'search' => $kecamatan->nama_kecamatan,
                    'layer' => 'kecamatan',
                ])),
            ]);

        $tourismSuggestions = collect();
        if (Schema::hasTable('lokasi_wisata')) {
            $tourismSuggestions = DB::table('lokasi_wisata')
                ->where('nama_lokasi', 'like', $like)
                ->orderBy('nama_lokasi')
                ->limit(4)
                ->get(['nama_lokasi', 'alamat'])
                ->map(fn (object $wisata): array => [
                    'title' => $wisata->nama_lokasi ?: 'Lokasi wisata',
                    'type' => 'Wisata',
                    'description' => $wisata->alamat ?: 'Lokasi wisata di Kabupaten Tuban.',
                    'url' => url('/data-spasial?'.http_build_query([
                        'search' => $wisata->nama_lokasi,
                        'filter' => 'wisata',
                    ])),
                ]);
        }

        return response()->json(
            $pageSuggestions
                ->concat($villageSuggestions)
                ->concat($districtSuggestions)
                ->concat($tourismSuggestions)
                ->take(8)
                ->values()
        )->header('Cache-Control', 'no-store, private');
    }

    public function search(Request $request)
    {
        $searchTerm = trim($request->string('q')->toString());

        if ($searchTerm === '') {
            return redirect()->route('home');
        }

        $terms = array_values(array_filter(preg_split('/\s+/', Str::lower($searchTerm)) ?: []));
        $villageTerms = $this->withoutSearchPrefixes($terms, ['desa', 'kelurahan']);
        $districtTerms = $this->withoutSearchPrefixes($terms, ['kecamatan']);
        $tourismTerms = $this->withoutSearchPrefixes($terms, ['wisata', 'destinasi', 'lokasi']);
        $sections = [
            [
                'group' => 'Informasi',
                'title' => 'Tentang Kami',
                'description' => 'Tujuan platform dan inovasi ekosistem desa digital Kabupaten Tuban.',
                'url' => url('/#tentang-kami'),
                'keywords' => 'tentang kami profil tujuan platform website resmi media sosial inovasi ekosistem desa digital',
            ],
            [
                'group' => 'Layanan',
                'title' => 'Gerbang Layanan Publik Digital',
                'description' => 'Akses website desa, peta spasial, surat desa, CCTV, dan e-PBB.',
                'url' => url('/#layanan-digital'),
                'keywords' => 'layanan pelayanan publik digital website desa peta spasial data desa surat administrasi cctv epbb pajak',
            ],
            [
                'group' => 'Informasi',
                'title' => 'Hubungi Kami - Diskominfo Tuban',
                'description' => 'Alamat, telepon, email, dan website Dinas Komunikasi, Informatika, Statistik dan Persandian Kabupaten Tuban.',
                'url' => url('/#hubungi-kami'),
                'keywords' => 'hubungi kontak alamat telepon email diskominfo komunikasi informatika statistik persandian mastrip',
            ],
            [
                'group' => 'Layanan',
                'title' => 'Direktori Website Desa',
                'description' => 'Jelajahi direktori website desa dan kecamatan di Kabupaten Tuban.',
                'url' => url('/website'),
                'keywords' => 'website desa kelurahan direktori kecamatan portal desa',
            ],
            [
                'group' => 'Layanan',
                'title' => 'Peta Data Spasial',
                'description' => 'Telusuri batas wilayah desa dan kecamatan serta lokasi wisata dan fasilitas publik.',
                'url' => url('/data-spasial'),
                'keywords' => 'data peta spasial wilayah desa kecamatan wisata lokasi fasilitas publik',
            ],
            [
                'group' => 'Layanan',
                'title' => 'Surat Desa',
                'description' => 'Akses layanan administrasi persuratan desa.',
                'url' => url('/surat'),
                'keywords' => 'surat layanan pelayanan administrasi desa dokumen',
            ],
            [
                'group' => 'Layanan',
                'title' => 'CCTV Tuban',
                'description' => 'Buka layanan CCTV Kabupaten Tuban.',
                'url' => url('/cctv'),
                'keywords' => 'cctv kamera pantau lalu lintas',
            ],
            [
                'group' => 'Layanan',
                'title' => 'e-PBB Tuban',
                'description' => 'Buka layanan pajak bumi dan bangunan Kabupaten Tuban.',
                'url' => url('/epbb'),
                'keywords' => 'epbb e-pbb pajak bumi bangunan pbb',
            ],
        ];

        $pageResults = collect($sections)
            ->filter(function (array $section) use ($terms): bool {
                $content = Str::lower($section['title'].' '.$section['description'].' '.$section['keywords']);

                return collect($terms)->every(fn (string $term): bool => Str::contains($content, $term));
            })
            ->map(fn (array $section): array => collect($section)->except('keywords')->all())
            ->values()
            ->all();

        $villageQuery = Desa::query()->with('kecamatan');
        $this->applySearchTerms($villageQuery, ['nama_desa'], $villageTerms);
        $villageResults = $villageQuery->orderBy('nama_desa')->limit(8)->get()
            ->map(fn (Desa $desa): array => [
                'title' => $desa->nama_desa,
                'description' => 'Desa di Kecamatan '.($desa->kecamatan?->nama_kecamatan ?? 'belum tercatat').'.',
                'url' => url('/data-spasial?'.http_build_query([
                    'search' => $desa->nama_desa,
                    'layer' => 'desa',
                ])),
            ])
            ->all();

        $districtQuery = Kecamatan::query();
        $this->applySearchTerms($districtQuery, ['nama_kecamatan'], $districtTerms);
        $districtResults = $districtQuery->orderBy('nama_kecamatan')->limit(8)->get()
            ->map(fn (Kecamatan $kecamatan): array => [
                'title' => 'Kecamatan '.$kecamatan->nama_kecamatan,
                'description' => 'Data wilayah kecamatan dan desa di Kabupaten Tuban.',
                'url' => url('/data-spasial?'.http_build_query([
                    'search' => $kecamatan->nama_kecamatan,
                    'layer' => 'kecamatan',
                ])),
            ])
            ->all();

        $tourismResults = [];
        if (Schema::hasTable('lokasi_wisata')) {
            $tourismQuery = DB::table('lokasi_wisata');
            $tourismColumns = ['nama_lokasi', 'properties'];
            if (Schema::hasColumn('lokasi_wisata', 'alamat')) {
                $tourismColumns[] = 'alamat';
            }
            $this->applySearchTerms($tourismQuery, $tourismColumns, $tourismTerms);
            $tourismResults = $tourismQuery->orderBy('nama_lokasi')->limit(8)->get()
                ->map(fn (object $wisata): array => [
                    'title' => $wisata->nama_lokasi ?: 'Lokasi wisata',
                    'description' => $wisata->alamat ?? 'Lokasi wisata di Kabupaten Tuban.',
                    'url' => url('/data-spasial?'.http_build_query([
                        'search' => $wisata->nama_lokasi ?: $searchTerm,
                        'filter' => 'wisata',
                    ])),
                ])
                ->all();
        }

        $groups = array_values(array_filter([
            ['title' => 'Informasi dan Layanan', 'items' => $pageResults],
            ['title' => 'Desa', 'items' => $villageResults],
            ['title' => 'Kecamatan', 'items' => $districtResults],
            ['title' => 'Wisata', 'items' => $tourismResults],
        ], fn (array $group): bool => $group['items'] !== []));

        return view('search-results', [
            'searchTerm' => $searchTerm,
            'groups' => $groups,
            'resultCount' => array_sum(array_map(fn (array $group): int => count($group['items']), $groups)),
        ]);
    }

    private function applySearchTerms($query, array $columns, array $terms): void
    {
        foreach ($terms as $term) {
            $query->where(function ($termQuery) use ($columns, $term): void {
                foreach ($columns as $column) {
                    $termQuery->orWhere($column, 'like', '%'.$term.'%');
                }
            });
        }
    }

    private function withoutSearchPrefixes(array $terms, array $prefixes): array
    {
        $filteredTerms = array_values(array_diff($terms, $prefixes));

        return $filteredTerms ?: $terms;
    }
}