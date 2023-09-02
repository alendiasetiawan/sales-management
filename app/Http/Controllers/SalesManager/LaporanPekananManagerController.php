<?php

namespace App\Http\Controllers\SalesManager;

use Carbon\Carbon;
use App\Models\Sales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\PoinSalesPekanan;
use App\Providers\JenisCallProvider;
use Illuminate\Support\Facades\Auth;
use App\Services\LaporanSalesPekananService;

class LaporanPekananManagerController extends Controller
{
    public function index(LaporanSalesPekananService $laporanPekanan) {
        $tanggal = Carbon::now();
        $pekan = $tanggal->weekOfMonth;
        $bulan = $tanggal->isoFormat('MMMM');
        $tahun = $tanggal->format('Y');
        $bulanTahun = $tanggal->isoFormat('MMMM Y');
        $tanggal1 = $tanggal->startOfWeek()->format('Y-m-d');
        $tanggal2 = $tanggal->startOfWeek()->addDay(1)->format('Y-m-d');
        $tanggal3 = $tanggal->startOfWeek()->addDay(2)->format('Y-m-d');
        $tanggal4 = $tanggal->startOfWeek()->addDay(3)->format('Y-m-d');
        $tanggal5 = $tanggal->startOfWeek()->addDay(4)->format('Y-m-d');
        $tanggal6 = $tanggal->startOfWeek()->addDay(5)->format('Y-m-d');
        $tanggal7 = $tanggal->endOfWeek()->format('Y-m-d');
        $jumlahCall = $laporanPekanan->jumlahCallPerPekanManager($pekan, $bulan, $tahun);
        $jumlahColdCall = $laporanPekanan->jumlahColdCallPerPekanManager($pekan, $bulan, $tahun);
        $jumlahWarmCall = $laporanPekanan->jumlahWarmCallPerPekanManager($pekan, $bulan, $tahun);
        $jumlahLeadGenerated = $laporanPekanan->jumlahLeadGeneratedPerPekanManager($pekan, $bulan, $tahun);
        $jumlahSalesClosing = $laporanPekanan->jumlahSalesClosingPerPekanManager($pekan, $bulan, $tahun);

        $data = [
            'title' => 'Laporan Sales Pekanan',
            'pekan' => $pekan,
            'bulanTahun' => $bulanTahun,
            'callSatu' => $laporanPekanan->callSatuManager($tanggal1),
            'callDua' => $laporanPekanan->callDuaManager($tanggal2),
            'callTiga' => $laporanPekanan->callTigaManager($tanggal3),
            'callEmpat' => $laporanPekanan->callEmpatManager($tanggal4),
            'callLima' => $laporanPekanan->callLimaManager($tanggal5),
            'callEnam' => $laporanPekanan->callEnamManager($tanggal6),
            'callTujuh' => $laporanPekanan->callTujuhManager($tanggal7),
            'hari1' => $tanggal->startOfWeek()->isoFormat('ddd'),
            'hari2' => $tanggal->startOfWeek()->addDay(1)->isoFormat('ddd'),
            'hari3' => $tanggal->startOfWeek()->addDay(2)->isoFormat('ddd'),
            'hari4' => $tanggal->startOfWeek()->addDay(3)->isoFormat('ddd'),
            'hari5' => $tanggal->startOfWeek()->addDay(4)->isoFormat('ddd'),
            'hari6' => $tanggal->startOfWeek()->addDay(5)->isoFormat('ddd'),
            'hari7' => $tanggal->startOfWeek()->addDay(6)->isoFormat('ddd'),
            'awalPekan' => $tanggal->startOfWeek()->isoFormat('D MMMM Y'),
            'akhirPekan' => $tanggal->endOfWeek()->isoFormat('D MMMM Y'),
            'pegawaiNip' => Auth::user()->email,
            'jumlahCall' => $jumlahCall,
            'jumlahColdCall' => $jumlahColdCall,
            'persenColdCall' => $laporanPekanan->persenColdCall($jumlahCall, $jumlahColdCall),
            'jumlahWarmCall' => $jumlahWarmCall,
            'persenWarmCall' => $laporanPekanan->persenWarmCall($jumlahCall, $jumlahWarmCall),
            'jumlahLeadGenerated' => $jumlahLeadGenerated,
            'persenLeadGenerated' => $laporanPekanan->persenLeadGenerated($jumlahCall, $jumlahLeadGenerated),
            'jumlahSalesClosing' => $jumlahSalesClosing,
            'persenSalesClosing' => $laporanPekanan->persenSalesClosing($jumlahCall, $jumlahSalesClosing),
            'customer' => Sales::pelangganPerPekanManager($pekan, $bulan, $tahun),
            'coldCall' => JenisCallProvider::COLD_CALL,
            'warmCall' => JenisCallProvider::WARM_CALL,
            'leadGenerated' => JenisCallProvider::LEAD_GENERATED,
            'salesClosing' => JenisCallProvider::SALES_CLOSING,
            'pegawai' => Pegawai::where('role_id', 1)->get(),
            'poinPegawai' => PoinSalesPekanan::poinPekanan($pekan, $bulan, $tahun)
        ];

        return view('sales_manager.laporan.laporan_sales_pekanan', $data);
    }

    public function show(Request $request, LaporanSalesPekananService $laporanPekanan) {
        $pegawaiNip = $request->pegawaiNip;

        $tanggal = Carbon::now();
        $pekan = $tanggal->weekOfMonth;
        $bulan = $tanggal->isoFormat('MMMM');
        $tahun = $tanggal->format('Y');
        $bulanTahun = $tanggal->isoFormat('MMMM Y');
        $tanggal1 = $tanggal->startOfWeek()->format('Y-m-d');
        $tanggal2 = $tanggal->startOfWeek()->addDay(1)->format('Y-m-d');
        $tanggal3 = $tanggal->startOfWeek()->addDay(2)->format('Y-m-d');
        $tanggal4 = $tanggal->startOfWeek()->addDay(3)->format('Y-m-d');
        $tanggal5 = $tanggal->startOfWeek()->addDay(4)->format('Y-m-d');
        $tanggal6 = $tanggal->startOfWeek()->addDay(5)->format('Y-m-d');
        $tanggal7 = $tanggal->endOfWeek()->format('Y-m-d');
        $jumlahCall = Sales::jumlahCallPerPekan($pegawaiNip, $pekan, $bulan, $tahun);
        $jumlahColdCall = Sales::jumlahColdCallPerPekan($pegawaiNip, $pekan, $bulan, $tahun);
        $jumlahWarmCall = Sales::jumlahWarmCallPerPekan($pegawaiNip, $pekan, $bulan, $tahun);
        $jumlahLeadGenerated = Sales::jumlahLeadGeneratedPerPekan($pegawaiNip, $pekan, $bulan, $tahun);
        $jumlahSalesClosing = Sales::jumlahSalesClosingPerPekan($pegawaiNip, $pekan, $bulan, $tahun);

        $data = [
            'title' => 'Laporan Sales Pekanan',
            'pekan' => $pekan,
            'bulanTahun' => $bulanTahun,
            'callSatu' => $laporanPekanan->callSatu($tanggal1, $pegawaiNip),
            'callDua' => $laporanPekanan->callDua($tanggal2, $pegawaiNip),
            'callTiga' => $laporanPekanan->callTiga($tanggal3, $pegawaiNip),
            'callEmpat' => $laporanPekanan->callEmpat($tanggal4, $pegawaiNip),
            'callLima' => $laporanPekanan->callLima($tanggal5, $pegawaiNip),
            'callEnam' => $laporanPekanan->callEnam($tanggal6, $pegawaiNip),
            'callTujuh' => $laporanPekanan->callTujuh($tanggal7, $pegawaiNip),
            'hari1' => $tanggal->startOfWeek()->isoFormat('ddd'),
            'hari2' => $tanggal->startOfWeek()->addDay(1)->isoFormat('ddd'),
            'hari3' => $tanggal->startOfWeek()->addDay(2)->isoFormat('ddd'),
            'hari4' => $tanggal->startOfWeek()->addDay(3)->isoFormat('ddd'),
            'hari5' => $tanggal->startOfWeek()->addDay(4)->isoFormat('ddd'),
            'hari6' => $tanggal->startOfWeek()->addDay(5)->isoFormat('ddd'),
            'hari7' => $tanggal->startOfWeek()->addDay(6)->isoFormat('ddd'),
            'awalPekan' => $tanggal->startOfWeek()->isoFormat('D MMMM Y'),
            'akhirPekan' => $tanggal->endOfWeek()->isoFormat('D MMMM Y'),
            'pegawaiNip' => $pegawaiNip,
            'jumlahCall' => $jumlahCall,
            'jumlahColdCall' => $jumlahColdCall,
            'persenColdCall' => $laporanPekanan->persenColdCall($jumlahCall, $jumlahColdCall),
            'jumlahWarmCall' => $jumlahWarmCall,
            'persenWarmCall' => $laporanPekanan->persenWarmCall($jumlahCall, $jumlahWarmCall),
            'jumlahLeadGenerated' => $jumlahLeadGenerated,
            'persenLeadGenerated' => $laporanPekanan->persenLeadGenerated($jumlahCall, $jumlahLeadGenerated),
            'jumlahSalesClosing' => $jumlahSalesClosing,
            'persenSalesClosing' => $laporanPekanan->persenSalesClosing($jumlahCall, $jumlahSalesClosing),
            'totalPoin' => Sales::totalPoinPerPekan($pegawaiNip, $pekan, $bulan, $tahun),
            'poinColdCall' => Sales::poinColdCallPerPekan($pegawaiNip, $pekan, $bulan, $tahun),
            'poinWarmCall' => Sales::poinWarmCallPerPekan($pegawaiNip, $pekan, $bulan, $tahun),
            'poinLeadGenerated' => Sales::poinLeadGeneratedPerPekan($pegawaiNip, $pekan, $bulan, $tahun),
            'poinSalesClosing' => Sales::poinSalesClosingPerPekan($pegawaiNip, $pekan, $bulan, $tahun),
            'customer' => Sales::pelangganPerPekan($pegawaiNip, $pekan, $bulan, $tahun),
            'coldCall' => JenisCallProvider::COLD_CALL,
            'warmCall' => JenisCallProvider::WARM_CALL,
            'leadGenerated' => JenisCallProvider::LEAD_GENERATED,
            'salesClosing' => JenisCallProvider::SALES_CLOSING,
            'dataPegawai' => Pegawai::where('nip', $pegawaiNip)->first(),
            'pegawai' => Pegawai::where('role_id', 1)->get(),
        ];

        return view('sales_manager.laporan.laporan_sales_pekanan_pegawai', $data);
    }
}
