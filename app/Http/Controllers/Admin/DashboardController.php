<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataBarang;
use App\Models\DataAkun;
use App\Models\DataRuang;
use App\Models\DataJurusan;
use App\Models\PeminjamanBarang;
use App\Models\PemeliharaanBarang;
use App\Models\DataKelas;
use App\Models\DataJenisBarang;
use App\Models\DataKategoriBarang;
use App\Models\DataPenanggungJawab;
use App\Models\DataAngkatan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{


    public function admin()
    {

        $jakartaTime = Carbon::now('Asia/Jakarta');
        $jakartaTime->locale('id'); // Set Indonesia

        $stats      = $this->getStats();
        $latest     = $this->getLatestData();
        $barangData = $this->getBarangData();

        return view('dashboard.admin', array_merge($stats, $latest, $barangData));
    }

    

    public function index()
    {
        $barangData = $this->getBarangData();
        $dataUser  = $this->getDataUser();

        return view('dashboard.user', array_merge($barangData, $dataUser));
    }

   

    // ─────────────────────────────────────────────────────────────
    // SHARED HELPERS
    // ─────────────────────────────────────────────────────────────

    

    private function getStats()
    {
        return Cache::remember('admin_dashboard_stats', 60, function () {

            $peminjamanStats = PeminjamanBarang::selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN status_peminjaman = 'dipinjam' THEN 1 ELSE 0 END) as aktif
        ")->first();



            return [
                'totalBarang'          => DataBarang::count(),
                'peminjaman'           => $peminjamanStats->total,
                'peminjamanAktif'      => $peminjamanStats->aktif,
                'pemeliharaan'         => PemeliharaanBarang::count(),
                'totalRuang'           => DataRuang::count(),
                'totalJurusan'         => DataJurusan::count(),
                'totalAkun'            => DataAkun::count(),
                'totalKelas'           => DataKelas::count(),
                'totalJenisBarang'     => DataJenisBarang::count(),
                'totalKategoriBarang'  => DataKategoriBarang::count(),
                'totalPenanggungJawab' => DataPenanggungJawab::count(),
                'totalAngkatan'        => DataAngkatan::count(),
            ];
        });
    }

    private function getLatestData()
    {

        return [
            'peminjamanTerbaru'   => PeminjamanBarang::latest()->take(5)->get(),
            'pemeliharaanTerbaru' => PemeliharaanBarang::latest()->take(4)->get(),
            
        ];
    }

    private function getBarangData()
    {
        $barang = DataBarang::withCount([
            'detail as dipinjam_count' => function ($q) {
                $q->whereHas('peminjaman', function ($sub) {
                    $sub->where('status_peminjaman', 'dipinjam');
                });
            }
        ])->with('jenis')->get();

        $barangTersedia = $barang->where('dipinjam_count', 0);
        $barangTidakTersedia = $barang->where('dipinjam_count', '>', 0);



        $topBarangRaw = DataBarang::withCount(['detail as detail_count' => function ($query) {
            $query->whereHas('peminjaman', function ($q) {
                $q->where('status_peminjaman', '!=', 'Pending');
            });
        }])
            ->whereHas('detail.peminjaman', function ($query) {
                $query->where('status_peminjaman', '!=', 'Pending');
            })
            ->with('jenis.kategori')
            ->orderByDesc('detail_count')
            ->limit(3)
            ->get();

        $requestPeminjaman = PeminjamanBarang::with([
            'user',
            'detail.barang.jenis'
        ])
            ->where('status_peminjaman', 'Pending')
            ->latest()
            ->get();

        $requestPengembalian = PeminjamanBarang::with([
            'user',
            'detail.barang.jenis'
        ])
            ->where('status_peminjaman', 'menunggu_kembali')
            ->latest()
            ->get();

        return [
            'topBarang'            => $topBarangRaw,
            'barangTersedia'       => $barangTersedia,
            'barangTidakTersedia'  => $barangTidakTersedia,
            
            'requestPeminjaman'    => $requestPeminjaman,
            'requestPengembalian'    => $requestPengembalian,
        ];
    }

    // ─────────────────────────────────────────────────────────────
    // SISWA
    // ─────────────────────────────────────────────────────────────


    private function getDataUser()
    {
        $userId = auth()->id();

        return [
            'peminjamanAktifUser' => PeminjamanBarang::where('user_id', $userId)
                ->where('status_peminjaman', 'dipinjam')
                ->count(),

            'pengembalianUser' => PeminjamanBarang::where('user_id', $userId)
                ->where('status_peminjaman', 'dikembalikan')
                ->count(),


            'totalRiwayatUser' => PeminjamanBarang::where('user_id', $userId)->count(),

            'peminjamanTerbaru' => PeminjamanBarang::with('detail.barang.jenis')
                ->where('user_id', $userId)
                ->latest()
                ->limit(10)
                ->get(),
        ];
    }

    
}
