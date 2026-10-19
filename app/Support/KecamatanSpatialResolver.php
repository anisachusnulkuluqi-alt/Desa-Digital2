<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KecamatanSpatialResolver
{
    private static ?array $desaToKecamatan = null;
    private static ?array $kecamatanPolygons = null;

    /**
     * Common aliases and normalization mappings.
     */
    private const ALIASES = [
        'panyuran' => 'Palang',
        'payuran' => 'Palang',
        'wukiharjo' => 'Parengan',
        'laju lor' => 'Singgahan',
        'lajulor' => 'Singgahan',
        'laju kidul' => 'Singgahan',
        'lajukidul' => 'Singgahan',
        'kebonsari' => 'Tuban',
        'karangsari' => 'Tuban',
        'doromukti' => 'Tuban',
        'kutorejo' => 'Tuban',
        'ronggomulyo' => 'Tuban',
        'sidomulyo' => 'Tuban',
        'sendangharjo' => 'Tuban',
        'baturetno' => 'Tuban',
        'kingking' => 'Tuban',
        'sukolilo' => 'Tuban',
        'perbon' => 'Tuban',
        'mondokan' => 'Tuban',
    ];

    /**
     * Resolve Kecamatan name for a given point and attributes.
     */
    public static function resolve(
        float|int|string|null $lng,
        float|int|string|null $lat,
        array $properties = [],
        ?string $name = null,
        ?string $address = null
    ): ?string {
        // 1. Direct property check
        foreach (['kecamatan', 'Kecamatan', 'kec', 'nama_kecamatan', 'nm_kecamatan'] as $key) {
            if (!empty($properties[$key]) && is_string($properties[$key])) {
                $clean = self::cleanKecamatanName($properties[$key]);
                if ($clean !== '') {
                    return $clean;
                }
            }
        }

        self::ensureDesaMapLoaded();

        // 2. Candidate village name check
        $candidateDesa = null;
        foreach (['desa', 'nama_desa', 'kelurahan', 'desa_kelur', 'Desa'] as $desaKey) {
            if (!empty($properties[$desaKey]) && is_string($properties[$desaKey])) {
                $candidateDesa = $properties[$desaKey];
                break;
            }
        }

        if ($candidateDesa) {
            $normalizedDesa = strtolower(trim(preg_replace('/^(desa|kelurahan)\s+/i', '', $candidateDesa)));
            if (isset(self::$desaToKecamatan[$normalizedDesa])) {
                return self::$desaToKecamatan[$normalizedDesa];
            }
        }

        // 3. Regex check on address / name for "Kec. [Name]" or "Kecamatan [Name]"
        $combinedText = trim(($name ?? '') . ' ' . ($address ?? '') . ' ' . ($properties['alamat'] ?? ''));
        if ($combinedText !== '') {
            $knownKecamatans = self::getKnownKecamatanNames();
            $pattern = '/\bkec(?:amatan)?\.?\s+(' . implode('|', $knownKecamatans) . ')\b/i';
            if (preg_match($pattern, $combinedText, $matches)) {
                $candidate = self::cleanKecamatanName($matches[1]);
                foreach ($knownKecamatans as $known) {
                    if (strcasecmp($known, $candidate) === 0) {
                        return $known;
                    }
                }
            }

            // 4. Check if any village name is present in address or name
            $lowerText = strtolower($combinedText);
            foreach (self::$desaToKecamatan as $desa => $kec) {
                if (strlen($desa) >= 4 && str_contains($lowerText, $desa)) {
                    return $kec;
                }
            }
        }

        // 5. Point in Polygon fallback using kecamatan.geojson
        $lngFloat = is_numeric($lng) ? (float) $lng : null;
        $latFloat = is_numeric($lat) ? (float) $lat : null;
        if ($lngFloat !== null && $latFloat !== null) {
            $fromPolygon = self::resolveByPointInPolygon($lngFloat, $latFloat);
            if ($fromPolygon) {
                return $fromPolygon;
            }
        }

        return null;
    }

    /**
     * Normalize kecamatan name (e.g. "Kecamatan Merakurak" -> "Merakurak").
     */
    public static function cleanKecamatanName(?string $value): string
    {
        $cleaned = trim((string) $value);
        $cleaned = preg_replace('/^\s*kec(?:amatan)?\.?\s*/i', '', $cleaned);
        $cleaned = preg_replace('/\s+kode\s+pos.*$/i', '', $cleaned);
        $cleaned = preg_replace('/\s+kab(?:upaten)?\.?\s+tuban.*$/i', '', $cleaned);
        $cleaned = trim($cleaned);

        if ($cleaned === '') {
            return '';
        }

        return ucwords(strtolower($cleaned));
    }

    /**
     * Load village-to-kecamatan lookup map.
     */
    public static function ensureDesaMapLoaded(): void
    {
        if (self::$desaToKecamatan !== null) {
            return;
        }

        self::$desaToKecamatan = self::ALIASES;

        if (Schema::hasTable('desa') && Schema::hasTable('kecamatan')) {
            try {
                $rows = DB::table('desa')
                    ->join('kecamatan', 'kecamatan.id', '=', 'desa.kecamatan_id')
                    ->select('desa.nama_desa', 'kecamatan.nama_kecamatan')
                    ->get();

                foreach ($rows as $row) {
                    $normDesa = strtolower(trim((string) $row->nama_desa));
                    if ($normDesa !== '') {
                        self::$desaToKecamatan[$normDesa] = self::cleanKecamatanName($row->nama_kecamatan);
                    }
                }
            } catch (\Throwable) {
                // Keep default aliases if query fails
            }
        }
    }

    /**
     * List of 20 known Kecamatan names in Tuban.
     */
    public static function getKnownKecamatanNames(): array
    {
        return [
            'Bancar', 'Bangilan', 'Grabagan', 'Jatirogo', 'Jenu',
            'Kenduruan', 'Kerek', 'Merakurak', 'Montong', 'Palang',
            'Parengan', 'Plumpang', 'Rengel', 'Semanding', 'Senori',
            'Singgahan', 'Soko', 'Tambakboyo', 'Tuban', 'Widang',
        ];
    }

    /**
     * Point in polygon check with bounding box acceleration.
     */
    private static function resolveByPointInPolygon(float $lng, float $lat): ?string
    {
        self::ensurePolygonsLoaded();

        if (empty(self::$kecamatanPolygons)) {
            return null;
        }

        $point = [$lng, $lat];

        foreach (self::$kecamatanPolygons as $item) {
            $bbox = $item['bbox'];
            if ($lng < $bbox[0] || $lng > $bbox[2] || $lat < $bbox[1] || $lat > $bbox[3]) {
                continue;
            }

            if (self::pointInGeometry($point, $item['geometry'])) {
                return $item['name'];
            }
        }

        return null;
    }

    private static function ensurePolygonsLoaded(): void
    {
        if (self::$kecamatanPolygons !== null) {
            return;
        }

        self::$kecamatanPolygons = [];
        $geojsonPath = public_path('geojson/kecamatan.geojson');

        if (!file_exists($geojsonPath)) {
            return;
        }

        $content = file_get_contents($geojsonPath);
        $data = json_decode($content, true);

        if (!isset($data['features']) || !is_array($data['features'])) {
            return;
        }

        foreach ($data['features'] as $f) {
            $name = self::cleanKecamatanName($f['properties']['nm_kecamatan'] ?? '');
            $geom = $f['geometry'] ?? null;
            if (!$geom || !isset($geom['type'], $geom['coordinates'])) {
                continue;
            }

            $minX = 180.0;
            $maxX = -180.0;
            $minY = 90.0;
            $maxY = -90.0;

            $rings = [];
            if ($geom['type'] === 'Polygon') {
                $rings = $geom['coordinates'];
            } elseif ($geom['type'] === 'MultiPolygon') {
                foreach ($geom['coordinates'] as $poly) {
                    foreach ($poly as $ring) {
                        $rings[] = $ring;
                    }
                }
            }

            foreach ($rings as $ring) {
                foreach ($ring as $pt) {
                    if ($pt[0] < $minX) $minX = (float) $pt[0];
                    if ($pt[0] > $maxX) $maxX = (float) $pt[0];
                    if ($pt[1] < $minY) $minY = (float) $pt[1];
                    if ($pt[1] > $maxY) $maxY = (float) $pt[1];
                }
            }

            self::$kecamatanPolygons[] = [
                'name' => $name,
                'bbox' => [$minX, $minY, $maxX, $maxY],
                'geometry' => $geom,
            ];
        }
    }

    private static function pointInGeometry(array $point, array $geometry): bool
    {
        if ($geometry['type'] === 'Polygon') {
            if (!self::pointInRing($point, $geometry['coordinates'][0])) {
                return false;
            }
            for ($i = 1; $i < count($geometry['coordinates']); $i++) {
                if (self::pointInRing($point, $geometry['coordinates'][$i])) {
                    return false;
                }
            }
            return true;
        }

        if ($geometry['type'] === 'MultiPolygon') {
            foreach ($geometry['coordinates'] as $polyCoordinates) {
                if (self::pointInRing($point, $polyCoordinates[0])) {
                    $inHole = false;
                    for ($i = 1; $i < count($polyCoordinates); $i++) {
                        if (self::pointInRing($point, $polyCoordinates[$i])) {
                            $inHole = true;
                            break;
                        }
                    }
                    if (!$inHole) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    private static function pointInRing(array $point, array $ring): bool
    {
        $x = $point[0];
        $y = $point[1];
        $inside = false;
        $n = count($ring);

        for ($i = 0, $j = $n - 1; $i < $n; $j = $i++) {
            $xi = $ring[$i][0];
            $yi = $ring[$i][1];
            $xj = $ring[$j][0];
            $yj = $ring[$j][1];

            $intersect = (($yi > $y) !== ($yj > $y))
                && ($x < ($xj - $xi) * ($y - $yi) / ($yj - $yi) + $xi);

            if ($intersect) {
                $inside = !$inside;
            }
        }

        return $inside;
    }
}
