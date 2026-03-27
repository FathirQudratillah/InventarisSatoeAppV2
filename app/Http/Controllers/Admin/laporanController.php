<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataBarang;
use App\Models\DataJenisBarang;
use App\Models\DataRuang;
use App\Models\DetailPeminjaman;
use App\Models\PemeliharaanBarang;
use App\Models\PeminjamanBarang;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;


class laporanController extends Controller
{
    public function index(Request $request)
    {
        Carbon::setLocale('id');
        $bulan = now()->format('m');
        $tahun = now()->format('Y');

        $namaBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ][$bulan];

        $data = DetailPeminjaman::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        return view('laporan.laporan', compact('data', 'namaBulan', 'tahun', 'bulan'));
    }

    public function peminjaman(Request $request)
    {
        Carbon::setLocale('id');
        $bulan = (int) request('bulan', now()->month);
        $tahun = (int) request('tahun', now()->year);

        $data = PeminjamanBarang::whereMonth('tanggal_peminjaman', $bulan)
            ->whereYear('tanggal_peminjaman', $tahun)
            ->latest('tanggal_peminjaman')
            ->get();

        $namaBulan = Carbon::create()->month($bulan)->locale('id')->translatedFormat('F');

        return view('laporan.laporan-peminjaman', compact('data', 'bulan', 'tahun', 'namaBulan'));
    }

    public function pemeliharaan(Request $request)
    {
        Carbon::setLocale('id');
        $bulan = now()->format('m');
        $tahun = now()->format('Y');
        $barangList = DataBarang::orderBy('kode_barang')->get();

        $data = PemeliharaanBarang::with(['penanggungjawab', 'barang'])
            ->when($request->kode_barang, function ($query) use ($request) {
                $query->where('kode_barang', $request->kode_barang);
            })
            ->orderBy('tanggal_pemeliharaan', 'asc')
            ->get();

        return view('laporan.laporan-pemeliharaan', [
            'data' => $data,
            'barangList' => $barangList
        ]);
    }

    public function cetakPeminjaman(Request $request)
    {
        Carbon::setLocale('id');
        $bulan = str_pad($request->bulan, 2, '0', STR_PAD_LEFT);
        $tahun = $request->tahun;

        $namaBulanList = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        $namaBulan = $namaBulanList[$bulan] ?? '-';
        $data = PeminjamanBarang::with(['user', 'detail.barang'])
            ->whereMonth('tanggal_peminjaman', $bulan)
            ->whereYear('tanggal_peminjaman', $tahun)
            ->latest('tanggal_peminjaman')
            ->get();

        $pdf = Pdf::loadView('pdf.pdf-peminjaman', [
            'data'      => $data,
            'namaBulan' => $namaBulan,
            'tahun'     => $tahun
        ]);

        $namaFile = 'laporan-peminjaman-' . strtolower($namaBulan) . '-' . $tahun . '-Inventaris-Smk Negeri 1 Kota Bekasi.pdf';

        return $pdf->setPaper('a4', 'portrait')->stream($namaFile);
    }

    public function cetakPemeliharaan(Request $request)
    {
        try {
            Carbon::setLocale('id');

            $bulan = $request->bulan
                ? str_pad($request->bulan, 2, '0', STR_PAD_LEFT)
                : date('m');

            $tahun = $request->tahun ?? date('Y');

            $namaBulanList = [
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember'
            ];

            $namaBulan = $namaBulanList[$bulan] ?? '-';
            $kodeBarang = $request->kode_barang;

            $query = PemeliharaanBarang::with(['penanggungjawab', 'barang.jenis'])->where('kode_barang', $kodeBarang);

            $data = $query->orderBy('tanggal_pemeliharaan', 'asc')->get();

            $pdf = Pdf::loadView('pdf.pdf-pemeliharaan', [
                'data'              => $data,
                'namaBulan'         => $namaBulan,
                'tahun'             => $tahun,
                'dataFirst'         => $query->first(),
            ]);

            if ($kodeBarang) {
                $namaFile = 'kartu-pemeliharaan-' . $kodeBarang . '.pdf';
            } else {
                $namaFile = 'laporan-pemeliharaan-'
                    . strtolower($namaBulan) . '-' . $tahun . '.pdf';
            }

            return $pdf->setPaper('a4', 'portrait')->stream($namaFile);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'request' => $request->all()
            ], 500);
        }
    }

    public function cetakQr(){
        $barangs = DataBarang::all();
        return view('laporan.cetakQr', compact('barangs'));
    }

    

    public function cetakQrPdf(Request $request)
    {
        $request->validate([
            'barang_ids' => 'required|array|min:1',
        ]);

        $barangs = DataBarang::whereIn('kode_barang', $request->barang_ids)->get();

        foreach ($barangs as $barang) {
            $result = Builder::create()
                ->writer(new PngWriter())
                ->data($barang->kode_barang)
                ->size(300)
                ->build();

            $barang->qr = base64_encode($result->getString());
        }

        $pdf = Pdf::loadView('pdf.qr-barang', compact('barangs'));

        return $pdf->download('qr-barang.pdf');
    }
}
