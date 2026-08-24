<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Karir;
use App\Models\Marketing;
use App\Models\Pelamar;
use App\Models\Testimoni;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the main admin dashboard with actual real-time database metrics & charts.
     */
    public function index()
    {
        // 1. KPI Statistics Counts
        $metrics = [
            'pelamar' => [
                'total' => Pelamar::count(),
                'pending' => Pelamar::where('status', 'Pending')->count(),
                'proses' => Pelamar::whereIn('status', ['Review', 'Wawancara'])->count(),
                'diterima' => Pelamar::where('status', 'Diterima')->count(),
                'ditolak' => Pelamar::where('status', 'Ditolak')->count(),
            ],
            'karir' => [
                'total' => Karir::count(),
                'aktif' => Karir::where('status', 'Aktif')->count(),
                'tutup' => Karir::where('status', 'Tutup')->count(),
                'total_departemen' => Karir::whereNotNull('departemen')->where('departemen', '!=', '')->distinct('departemen')->count('departemen'),
            ],
            'berita' => [
                'total' => Berita::count(),
                'published' => Berita::where('status', 'published')->count(),
                'draft' => Berita::where('status', 'draft')->count(),
            ],
            'marketing' => [
                'total' => Marketing::count(),
                'online' => Marketing::where('status', 'online')->count(),
                'offline' => Marketing::where('status', 'offline')->count(),
            ],
            'testimoni' => [
                'total' => Testimoni::count(),
                'published' => Testimoni::where('status', 'published')->count(),
                'draft' => Testimoni::where('status', 'draft')->count(),
            ],
            'gallery' => [
                'total' => Gallery::count(),
            ],
        ];

        // 2. Monthly Trend Data (12 Months of Current Year)
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $currentYear = Carbon::now()->year;

        $pelamarByMonth = Pelamar::whereYear('created_at', $currentYear)
            ->get(['created_at'])
            ->groupBy(fn ($item) => (int) $item->created_at->format('n'))
            ->map->count();

        $beritaByMonth = Berita::whereYear('created_at', $currentYear)
            ->get(['created_at'])
            ->groupBy(fn ($item) => (int) $item->created_at->format('n'))
            ->map->count();

        $pelamarMonthly = [];
        $beritaMonthly = [];

        for ($m = 1; $m <= 12; $m++) {
            $pelamarMonthly[] = $pelamarByMonth->get($m, 0);
            $beritaMonthly[] = $beritaByMonth->get($m, 0);
        }

        // 3. Status Pelamar Breakdown (Donut Chart)
        $statusPelamarCounts = [
            'Pending' => $metrics['pelamar']['pending'],
            'Review' => Pelamar::where('status', 'Review')->count(),
            'Wawancara' => Pelamar::where('status', 'Wawancara')->count(),
            'Diterima' => $metrics['pelamar']['diterima'],
            'Ditolak' => $metrics['pelamar']['ditolak'],
        ];

        // 4. Departemen Karir Distribution (Bar Chart)
        $deptDistribution = Karir::select('departemen', DB::raw('count(*) as total'))
            ->whereNotNull('departemen')
            ->where('departemen', '!=', '')
            ->groupBy('departemen')
            ->orderByDesc('total')
            ->get();

        $deptLabels = $deptDistribution->pluck('departemen')->toArray();
        $deptCounts = $deptDistribution->pluck('total')->toArray();

        // 5. Recent Lists
        $recentPelamars = Pelamar::with('karir')->latest()->take(5)->get();
        $popularKarirs = Karir::withCount('pelamars')->orderByDesc('pelamars_count')->take(4)->get();
        $recentBeritas = Berita::latest()->take(4)->get();
        $marketings = Marketing::latest()->take(4)->get();

        return view('admin.dashboard', compact(
            'metrics',
            'months',
            'pelamarMonthly',
            'beritaMonthly',
            'statusPelamarCounts',
            'deptLabels',
            'deptCounts',
            'recentPelamars',
            'popularKarirs',
            'recentBeritas',
            'marketings'
        ));
    }
}
