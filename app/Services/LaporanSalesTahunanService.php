<?php

namespace App\Services;

use App\Models\Sales;
use App\Providers\JenisCallProvider;


class LaporanSalesTahunanService {

    public function maxDataChart($pegawaiNip, $tahun) {

        $coldCall = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::COLD_CALL)
        ->count();

        $warmCall = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::WARM_CALL)
        ->count();

        $leadGenerated = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::LEAD_GENERATED)
        ->count();

        $salesClosing = Sales::where('pegawai_nip', $pegawaiNip)
        ->where('tahun', $tahun)
        ->where('status_sales', JenisCallProvider::SALES_CLOSING)
        ->count();

        $max = collect([$coldCall, $warmCall, $leadGenerated, $salesClosing])->max();
        $batasData = $max + 1;

        return $batasData;
    }

}
