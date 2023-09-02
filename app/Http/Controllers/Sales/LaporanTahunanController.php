<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\PoinSales;
use App\Models\RefBulan;
use App\Models\Sales;
use App\Providers\JenisCallProvider;
use App\Providers\PoinSalesProvider;
use App\Services\LaporanSalesTahunanService;
use App\Services\PoinSalesService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LaporanTahunanController extends Controller
{
    public function index(PoinSalesService $poinSales, LaporanSalesTahunanService $laporanSales) {

        $tahun = Carbon::now()->format('Y');
        $pegawaiNip = Auth::user()->email;
        $totalPoin = Sales::totalPoinPerTahun($pegawaiNip, $tahun);

        $data = [
            'title' => 'Laporan Sales Tahunan',
            'coldCall' => JenisCallProvider::COLD_CALL,
            'warmCall' => JenisCallProvider::WARM_CALL,
            'leadGenerated' => JenisCallProvider::LEAD_GENERATED,
            'salesClosing' => JenisCallProvider::SALES_CLOSING,
            'coldCallTahunan' => Sales::coldCallPerTahun($pegawaiNip, $tahun),
            'warmCallTahunan' => Sales::warmCallPerTahun($pegawaiNip, $tahun),
            'leadGeneratedTahunan' => Sales::leadGeneratedPerTahun($pegawaiNip, $tahun),
            'salesClosingTahunan' => Sales::salesClosingPerTahun($pegawaiNip, $tahun),
            'jumlahCallTahunan' => Sales::where('pegawai_nip', $pegawaiNip)->where('tahun', $tahun)->count(),
            'tahun' => $tahun,
            'jumlahColdCall' => Sales::where('tahun', $tahun)->where('status_sales', JenisCallProvider::COLD_CALL)->count(),
            'jumlahWarmCall' => Sales::where('tahun', $tahun)->where('status_sales', JenisCallProvider::WARM_CALL)->count(),
            'jumlahLeadGenerated' => Sales::where('tahun', $tahun)->where('status_sales', JenisCallProvider::LEAD_GENERATED)->count(),
            'jumlahSalesClosing' => Sales::where('tahun', $tahun)->where('status_sales', JenisCallProvider::SALES_CLOSING)->count(),
            'salesTahunan' => PoinSales::salesTahunan($pegawaiNip, $tahun),
            'refBulan' => RefBulan::all(),
            'totalPoin' => $totalPoin,
            'poinExcellent' => PoinSalesProvider::POIN_EXCELLENT_TAHUN,
            'insentif' => $poinSales->insentifTahunan($totalPoin),
            'totalInsentif' => $poinSales->totalInsentifTahunan($totalPoin),
            'komisiTambahan' => PoinSalesProvider::KOMISI_TAMBAHAN_TAHUN,
            'customer' => Sales::riwayatPelangganPerTahun($pegawaiNip, $tahun),
            'maxData' => $laporanSales->maxDataChart($pegawaiNip, $tahun),
        ];

        return view('sales.laporan.laporan_sales_tahunan', $data);
    }
}
