<?php

namespace App\Http\Controllers\SalesManager;

use Carbon\Carbon;
use App\Models\Sales;
use App\Models\RefPekan;
use App\Models\PoinSales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\JenisCallProvider;
use App\Services\LaporanSalesBulananService;

class DashboardController extends Controller
{
    public function index(LaporanSalesBulananService $laporanSales) {

        $tanggal = Carbon::now()->format('Y-m-d');
        $bulan = Carbon::now()->isoFormat('MMMM');
        $tahun = Carbon::now()->format('Y');

        $data = [
            'title' => 'Dashboard Sales Manager',
            'hariIni' => Carbon::now()->isoFormat('D MMMM Y'),
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'coldCall' => JenisCallProvider::COLD_CALL,
            'warmCall' => JenisCallProvider::WARM_CALL,
            'leadGenerated' => JenisCallProvider::LEAD_GENERATED,
            'salesClosing' => JenisCallProvider::SALES_CLOSING,
            'salesBulanan' => PoinSales::salesBulananManager($bulan, $tahun),
            'transaksiPerBulan' => Sales::where('bulan', $bulan)->where('tahun', $tahun)->sum('harga_total'),
            'unitPerBulan' => Sales::where('bulan', $bulan)->where('tahun', $tahun)->sum('unit'),
            'totalSalesClosing' => Sales::where('bulan', $bulan)->where('tahun', $tahun)->where('status_sales', JenisCallProvider::SALES_CLOSING)->count(),
            'salesHarian' => PoinSales::salesHarianManager($tanggal),
            'customerTerakhir' => Sales::customerTerakhirManager(),
            'coldCallBulanan' => RefPekan::coldCallPerBulanManager($bulan, $tahun),
            'warmCallBulanan' => RefPekan::warmCallPerBulanManager($bulan, $tahun),
            'leadGeneratedBulanan' => RefPekan::leadGeneratedPerBulanManager($bulan, $tahun),
            'salesClosingBulanan' => RefPekan::salesClosingPerBulanManager($bulan, $tahun),
            'jumlahCallBulanan' => Sales::where('bulan', $bulan)->where('tahun', $tahun)->count(),
            'jumlahColdCall' => Sales::coldCallPerBulanManager($bulan, $tahun),
            'jumlahWarmCall' => Sales::warmCallPerBulanManager($bulan, $tahun),
            'jumlahLeadGenerated' => Sales::leadGeneratedPerBulanManager($bulan, $tahun),
            'jumlahSalesClosing' => Sales::salesClosingPerBulanManager($bulan, $tahun),
            'maxData' => $laporanSales->maxDataChartManager($bulan, $tahun),
        ];

        return view('sales_manager.dashboard', $data);
    }
}
