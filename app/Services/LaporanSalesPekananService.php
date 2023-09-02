<?php

namespace App\Services;

use App\Models\Sales;
use App\Providers\JenisCallProvider;
use Illuminate\Support\Facades\Auth;


class LaporanSalesPekananService {

    public function callSatu($tanggal1, $pegawaiNip) {

        $jumlahCall = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('tanggal', $tanggal1)
        ->count();

        return $jumlahCall;
    }

    public function callDua($tanggal2, $pegawaiNip) {

        $jumlahCall = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('tanggal', $tanggal2)
        ->count();

        return $jumlahCall;
    }

    public function callTiga($tanggal3, $pegawaiNip) {

        $jumlahCall = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('tanggal', $tanggal3)
        ->count();

        return $jumlahCall;
    }

    public function callEmpat($tanggal4, $pegawaiNip) {

        $jumlahCall = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('tanggal', $tanggal4)
        ->count();

        return $jumlahCall;
    }

    public function callLima($tanggal5, $pegawaiNip) {

        $jumlahCall = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('tanggal', $tanggal5)
        ->count();

        return $jumlahCall;
    }

    public function callEnam($tanggal6, $pegawaiNip) {

        $jumlahCall = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('tanggal', $tanggal6)
        ->count();

        return $jumlahCall;
    }

    public function callTujuh($tanggal7, $pegawaiNip) {

        $jumlahCall = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('tanggal', $tanggal7)
        ->count();

        return $jumlahCall;
    }

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



    //Hitung jumlah call per pekan
    public function jumlahCallPerPekanManager($pekan, $bulan, $tahun) {
        return Sales::where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->count();
    }

    //Hitung jumlah COLD call per pekan
    public function jumlahColdCallPerPekanManager($pekan, $bulan, $tahun) {
        return Sales::where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::COLD_CALL)
        ->count();
    }

    //Hitung jumlah WARM call per pekan
    public function jumlahWarmCallPerPekanManager($pekan, $bulan, $tahun) {
        return Sales::where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::WARM_CALL)
        ->count();
    }

    //Hitung jumlah Lead Generated per pekan
    public function jumlahLeadGeneratedPerPekanManager($pekan, $bulan, $tahun) {
        return Sales::where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::LEAD_GENERATED)
        ->count();
    }

    public static function jumlahSalesClosingPerPekanManager($pekan, $bulan, $tahun) {
        return Sales::where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::SALES_CLOSING)
        ->count();
    }

    public function callSatuManager($tanggal1) {

        $jumlahCall = Sales::where('tanggal', $tanggal1)
        ->count();

        return $jumlahCall;
    }

    public function callDuaManager($tanggal2) {

        $jumlahCall = Sales::where('tanggal', $tanggal2)
        ->count();

        return $jumlahCall;
    }

    public function callTigaManager($tanggal3) {

        $jumlahCall = Sales::where('tanggal', $tanggal3)
        ->count();

        return $jumlahCall;
    }

    public function callEmpatManager($tanggal4) {

        $jumlahCall = Sales::where('tanggal', $tanggal4)
        ->count();

        return $jumlahCall;
    }

    public function callLimaManager($tanggal5) {

        $jumlahCall = Sales::where('tanggal', $tanggal5)
        ->count();

        return $jumlahCall;
    }

    public function callEnamManager($tanggal6) {

        $jumlahCall = Sales::where('tanggal', $tanggal6)
        ->count();

        return $jumlahCall;
    }

    public function callTujuhManager($tanggal7) {

        $jumlahCall = Sales::where('tanggal', $tanggal7)
        ->count();

        return $jumlahCall;
    }


    //Hitung jumlah total poin per pekan
    public static function totalPoinPerPekanManager($pekan, $bulan, $tahun) {
        return Sales::where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->sum('poin');
    }

    //Hitung jumlah poin Cold Call per pekan
    public static function poinColdCallPerPekanManager($pekan, $bulan, $tahun) {
        return Sales::where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::COLD_CALL)
        ->sum('poin');
    }

    //Hitung jumlah poin Warm Call per pekan
    public static function poinWarmCallPerPekanManager($pekan, $bulan, $tahun) {
        return Sales::where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::WARM_CALL)
        ->sum('poin');
    }

    //Hitung jumlah poin Lead Generated per pekan
    public static function poinLeadGeneratedPerPekanManager($pekan, $bulan, $tahun) {
        return Sales::where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::LEAD_GENERATED)
        ->sum('poin');
    }

    //Hitung jumlah poin Sales Closing per pekan
    public static function poinSalesClosingPerPekanManager($pekan, $bulan, $tahun) {
        return Sales::where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::SALES_CLOSING)
        ->sum('poin');
    }

}

