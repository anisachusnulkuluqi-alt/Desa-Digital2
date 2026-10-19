<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurveiKepuasan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SurveiKepuasanController extends Controller
{
    /**
     * Tampilkan halaman daftar penerimaan survei kepuasan masyarakat beserta statistik ringkasan.
     */
    public function index(Request $request)
    {
        $search = trim($request->string('search')->toString());
        $ratingFilter = $request->integer('rating');
        $timeFilter = $request->string('time')->toString();

        $query = SurveiKepuasan::whereNull('feedback_removed_at');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('message', 'like', "%{$search}%")
                  ->orWhere('nama', 'like', "%{$search}%")
                  ->orWhere('pekerjaan', 'like', "%{$search}%")
                  ->orWhere('device', 'like', "%{$search}%")
                  ->orWhere('browser', 'like', "%{$search}%");
            });
        }

        if ($ratingFilter >= 1 && $ratingFilter <= 5) {
            $query->where('rating', $ratingFilter);
        }

        if ($timeFilter === 'today') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($timeFilter === 'week') {
            $query->where('created_at', '>=', Carbon::now()->subDays(7));
        } elseif ($timeFilter === 'month') {
            $query->where('created_at', '>=', Carbon::now()->subDays(30));
        }

        $surveis = (clone $query)
            ->latest('created_at')
            ->paginate(15)
            ->withQueryString();

        // Statistik Keseluruhan
        $totalSurvei = SurveiKepuasan::count();
        $avgRating = $totalSurvei > 0 ? round((float) SurveiKepuasan::avg('rating'), 1) : 0;
        
        $puasCount = SurveiKepuasan::whereIn('rating', [4, 5])->count();
        $persentaseKepuasan = $totalSurvei > 0 ? round(($puasCount / $totalSurvei) * 100) : 0;

        $surveiHariIni = SurveiKepuasan::whereDate('created_at', Carbon::today())->count();

        // Distribusi Rating 1 - 5
        $ratingDistribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = SurveiKepuasan::where('rating', $i)->count();
            $pct = $totalSurvei > 0 ? round(($count / $totalSurvei) * 100) : 0;
            $ratingDistribution[$i] = [
                'count' => $count,
                'percentage' => $pct,
            ];
        }

        return view('admin.survei.index', compact(
            'surveis',
            'totalSurvei',
            'avgRating',
            'persentaseKepuasan',
            'surveiHariIni',
            'ratingDistribution',
            'search',
            'ratingFilter',
            'timeFilter'
        ));
    }

    /**
     * Hapus satu data penerimaan survei kepuasan.
     */
    public function destroy($id)
    {
        $survei = SurveiKepuasan::whereNull('feedback_removed_at')->findOrFail($id);
        $survei->update([
            'visitor_hash' => hash('sha256', random_bytes(32)),
            'nama' => null,
            'pekerjaan' => null,
            'message' => null,
            'feedback_removed_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Data tanggapan survei kepuasan berhasil dihapus.');
    }

    /**
     * Ekspor data penerimaan survei kepuasan ke format CSV.
     */
    public function exportCsv(Request $request): StreamedResponse
    {
        $ratingFilter = $request->integer('rating');
        $timeFilter = $request->string('time')->toString();

        $query = SurveiKepuasan::whereNull('feedback_removed_at');

        if ($ratingFilter >= 1 && $ratingFilter <= 5) {
            $query->where('rating', $ratingFilter);
        }

        if ($timeFilter === 'today') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($timeFilter === 'week') {
            $query->where('created_at', '>=', Carbon::now()->subDays(7));
        } elseif ($timeFilter === 'month') {
            $query->where('created_at', '>=', Carbon::now()->subDays(30));
        }

        $items = $query->latest('created_at')->get();
        $filename = 'survei-kepuasan-desa-digital-' . date('Y-m-d') . '.csv';

        return response()->streamDownload(function () use ($items) {
            $handle = fopen('php://output', 'w');
            
            // UTF-8 BOM untuk kompatibilitas Excel
            fputs($handle, "\xEF\xBB\xBF");

            // Header CSV
            fputcsv($handle, [
                'No',
                'Tanggal',
                'Waktu',
                'Perangkat',
                'Browser',
                'Nama Responden',
                'Kategori / Profesi',
                'Nilai Skor (1-5)',
                'Tingkat Kepuasan',
                'Kritik / Saran / Masukan',
            ]);

            $no = 1;
            foreach ($items as $item) {
                fputcsv($handle, [
                    $no++,
                    $item->created_at ? $item->created_at->format('d/m/Y') : '-',
                    $item->created_at ? $item->created_at->format('H:i') . ' WIB' : '-',
                    $item->device_label,
                    $item->browser_label,
                    $item->display_name,
                    $item->display_pekerjaan,
                    $item->rating,
                    $item->rating_label,
                    $item->message ?? '-',
                ]);
            }

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}
