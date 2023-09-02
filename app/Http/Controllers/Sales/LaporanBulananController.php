<?php

namespace App\Http\Controllers\Sales;

use Carbon\Carbon;
use App\Models\Sales;
use App\Models\RefBulan;
use Illuminate\Http\Request;
use App\Services\PoinSalesService;
use App\Http\Controllers\Controller;
use App\Providers\JenisCallProvider;
use App\Providers\PoinSalesProvider;
use Illuminate\Support\Facades\Auth;
use App\Services\LaporanSalesBulananService;

class LaporanBulananController extends Controller
{
    public function index(LaporanSalesBulananService $laporan, Request $request, PoinSalesService $poinSales) {

        $tanggal = Carbon::now();
        $pegawaiNip = Auth::user()->email;

        if ($request->has('pilihBulan')) {
            $cari = 1;
            $bulan = $request->pilihBulan;
            $tahun = $request->pilihTahun;
        } else {
            $bulan = $tanggal->isoFormat('MMMM');
            $tahun = $tanggal->format('Y');
            $cari = 0;
        }

        $jumlahCall = Sales::jumlahCallPerBulan($pegawaiNip, $bulan, $tahun);
        $jumlahColdCall = Sales::jumlahColdCallPerBulan($pegawaiNip, $bulan, $tahun);
        $jumlahWarmCall = Sales::jumlahWarmCallPerBulan($pegawaiNip, $bulan, $tahun);
        $jumlahLeadGenerated = Sales::jumlahLeadGeneratedPerBulan($pegawaiNip, $bulan, $tahun);
        $jumlahSalesClosing = Sales::jumlahSalesClosingPerBulan($pegawaiNip, $bulan, $tahun);
        $totalPoin = Sales::totalPoinPerBulan($pegawaiNip, $bulan, $tahun);

        $data = [
            'title' => 'Laporan Sales Bulanan',
            'jumlahCall' => $jumlahCall,
            'jumlahColdCall' => $jumlahColdCall,
            'jumlahWarmCall' => $jumlahWarmCall,
            'jumlahLeadGenerated' => $jumlahLeadGenerated,
            'jumlahSalesClosing' => $jumlahSalesClosing,
            'persenColdCall' => $laporan->persenColdCall($jumlahCall, $jumlahColdCall),
            'persenWarmCall' => $laporan->persenWarmCall($jumlahCall, $jumlahWarmCall),
            'persenLeadGenerated' => $laporan->persenLeadGenerated($jumlahCall, $jumlahLeadGenerated),
            'persenSalesClosing' => $laporan->persenSalesClosing($jumlahCall, $jumlahSalesClosing),
            'bulan' => $bulan,
            'tahun' => $tahun,
            'cari' => $cari,
            'refBulan' => RefBulan::all(),
            'totalPoin' => $totalPoin,
            'poinColdCall' => Sales::poinColdCallPerBulan($pegawaiNip, $bulan, $tahun),
            'poinWarmCall' => Sales::poinWarmCallPerBulan($pegawaiNip, $bulan, $tahun),
            'poinLeadGenerated' => Sales::poinLeadGeneratedPerBulan($pegawaiNip, $bulan, $tahun),
            'poinSalesClosing' => Sales::poinSalesClosingPerBulan($pegawaiNip, $bulan, $tahun),
            'insentif' => $poinSales->insentifBulanan($totalPoin),
            'totalInsentif' => $poinSales->totalInsentifBulanan($totalPoin),
            'poinExcellent' => PoinSalesProvider::POIN_EXCELLENT,
            'komisiTambahan' => PoinSalesProvider::KOMISI_TAMBAHAN,
            'customer' => Sales::riwayatPelangganPerBulan($pegawaiNip, $bulan, $tahun),
            'coldCall' => JenisCallProvider::COLD_CALL,
            'warmCall' => JenisCallProvider::WARM_CALL,
            'leadGenerated' => JenisCallProvider::LEAD_GENERATED,
            'salesClosing' => JenisCallProvider::SALES_CLOSING
        ];

        return view('sales.laporan.laporan_sales_bulanan', $data);
    }
}
