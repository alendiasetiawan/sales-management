<?php

namespace App\Http\Controllers\Sales;

use Carbon\Carbon;
use App\Models\Sales;
use App\Services\PoinSalesService;
use App\Http\Controllers\Controller;
use App\Models\RefPekan;
use App\Providers\JenisCallProvider;
use App\Providers\PoinSalesProvider;
use App\Services\LaporanSalesBulananService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(PoinSalesService $poinSales, LaporanSalesBulananService $laporanSales) {

        $pegawaiNip = Auth::user()->email;
        $tanggal = Carbon::now();
        $bulan = $tanggal->isoFormat('MMMM');
        $tahun = $tanggal->format('Y');
        $totalPoin = Sales::totalPoinPerBulan($pegawaiNip, $bulan, $tahun);

        $data = [
            'title' => 'Dashboard Sales',
            'insentif' => $poinSales->insentifBulanan($totalPoin),
            'totalInsentif' => $poinSales->totalInsentifBulanan($totalPoin),
            'poinExcellent' => PoinSalesProvider::POIN_EXCELLENT,
            'totalPoin' => $totalPoin,
            'namaUser' => Auth::user()->nama,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jumlahColdCall' => Sales::jumlahColdCallPerBulan($pegawaiNip, $bulan, $tahun),
            'jumlahWarmCall' => Sales::jumlahWarmCallPerBulan($pegawaiNip, $bulan, $tahun),
            'jumlahLeadGenerated' => Sales::jumlahLeadGeneratedPerBulan($pegawaiNip, $bulan, $tahun),
            'jumlahSalesClosing' => Sales::jumlahSalesClosingPerBulan($pegawaiNip, $bulan, $tahun),
            'coldCall' => JenisCallProvider::COLD_CALL,
            'warmCall' => JenisCallProvider::WARM_CALL,
            'leadGenerated' => JenisCallProvider::LEAD_GENERATED,
            'salesClosing' => JenisCallProvider::SALES_CLOSING,
            'customerTerakhir' => Sales::customerTerakhir($pegawaiNip),
            'coldCallBulanan' => RefPekan::coldCallPerBulan($pegawaiNip, $bulan, $tahun),
            'warmCallBulanan' => RefPekan::warmCallPerBulan($pegawaiNip, $bulan, $tahun),
            'leadGeneratedBulanan' => RefPekan::leadGeneratedPerBulan($pegawaiNip, $bulan, $tahun),
            'salesClosingBulanan' => RefPekan::salesClosingPerBulan($pegawaiNip, $bulan, $tahun),
            'jumlahCallBulanan' => Sales::where('bulan', $bulan)->where('tahun', $tahun)->where('pegawai_nip', $pegawaiNip)->count(),
            'poinColdCall' => Sales::poinColdCallPerBulan($pegawaiNip, $bulan, $tahun),
            'poinWarmCall' => Sales::poinWarmCallPerBulan($pegawaiNip, $bulan, $tahun),
            'poinLeadGenerated' => Sales::poinLeadGeneratedPerBulan($pegawaiNip, $bulan, $tahun),
            'poinSalesClosing' => Sales::poinSalesClosingPerBulan($pegawaiNip, $bulan, $tahun),
            'komisiTambahan' => PoinSalesProvider::KOMISI_TAMBAHAN,
            'maxData' => $laporanSales->maxDataChart($pegawaiNip, $bulan, $tahun),
        ];

        return view('sales.dashboard', $data);
    }
}
