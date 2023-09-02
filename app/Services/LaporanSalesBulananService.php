<?php

namespace App\Services;

use App\Models\Sales;
use App\Providers\JenisCallProvider;
use Illuminate\Support\Facades\Auth;


class LaporanSalesBulananService {

    public function persenColdCall($jumlahCall, $jumlahColdCall) {
        if($jumlahCall == 0) {
            $persen = 0;
        } else {
            $persen = round(($jumlahColdCall/$jumlahCall) * 100,2);
        }

        return $persen;
    }

    public function persenWarmCall($jumlahCall, $jumlahWarmCall) {

        if($jumlahCall == 0) {
            $persen = 0;
        } else {
            $persen = round(($jumlahWarmCall/$jumlahCall) * 100,2);
        }

        return $persen;
    }

    public function persenLeadGenerated($jumlahCall, $jumlahLeadGenerated) {

        if($jumlahCall == 0) {
            $persen = 0;
        } else {
            $persen = round(($jumlahLeadGenerated/$jumlahCall) * 100,2);
        }

        return $persen;
    }

    public function persenSalesClosing($jumlahCall, $jumlahSalesClosing) {

        if($jumlahCall == 0) {
            $persen = 0;
        } else {
            $persen = round(($jumlahSalesClosing/$jumlahCall) * 100,2);
        }

        return $persen;
    }

    public function maxDataChart($pegawaiNip, $bulan, $tahun) {

        $coldCall = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::COLD_CALL)
        ->count();

        $warmCall = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::WARM_CALL)
        ->count();

        $leadGenerated = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::LEAD_GENERATED)
        ->count();

        $salesClosing = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::SALES_CLOSING)
        ->count();

        $max = collect([$coldCall, $warmCall, $leadGenerated, $salesClosing])->max();
        $batasData = $max + 1;

        return $batasData;
    }

    public function maxDataChartManager($bulan, $tahun) {

        $coldCall = Sales::where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::COLD_CALL)
        ->count();

        $warmCall = Sales::where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::WARM_CALL)
        ->count();

        $leadGenerated = Sales::where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::LEAD_GENERATED)
        ->count();

        $salesClosing = Sales::where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::SALES_CLOSING)
        ->count();

        $max = collect([$coldCall, $warmCall, $leadGenerated, $salesClosing])->max();
        $batasData = $max + 1;

        return $batasData;
    }

}
