<?php

namespace App\Services;

use App\Models\PoinSalesBulanan;
use App\Models\PoinSalesPekanan;
use App\Models\PoinSalesTahunan;
use App\Providers\PoinSalesProvider;

class PoinSalesService {

    public function poinPekanan($pegawaiNip, $pekanAktif, $bulanAktif, $tahunAktif, $poin) {
        $cekPoinPekanan = PoinSalesPekanan::where('pegawai_nip', $pegawaiNip)
        ->where('pekan', $pekanAktif)
        ->where('bulan', $bulanAktif)
        ->where('tahun', $tahunAktif)
        ->count();

        if ($cekPoinPekanan == 0) {
            $totalPoin = $poin;
        } else {
            $poinPekanan = PoinSalesPekanan::where('pegawai_nip', $pegawaiNip)
            ->where('pekan', $pekanAktif)
            ->where('bulan', $bulanAktif)
            ->where('tahun', $tahunAktif)
            ->first();
            $jumlahPoin = $poinPekanan->total_poin;
            $totalPoin = $jumlahPoin + $poin;
        }

        return $totalPoin;
    }

    public function poinBulanan($pegawaiNip, $bulanAktif, $tahunAktif, $poin) {
        $cekPoinBulanan = PoinSalesBulanan::where('pegawai_nip', $pegawaiNip)
        ->where('bulan', $bulanAktif)
        ->where('tahun', $tahunAktif)
        ->count();

        if ($cekPoinBulanan == 0) {
            $totalPoin = $poin;
        } else {
            $poinBulanan = PoinSalesBulanan::where('pegawai_nip', $pegawaiNip)
            ->where('bulan', $bulanAktif)
            ->where('tahun', $tahunAktif)
            ->first();
            $jumlahPoin = $poinBulanan->total_poin;
            $totalPoin = $jumlahPoin + $poin;
        }

        return $totalPoin;
    }

    public function poinTahunan($pegawaiNip, $tahunAktif, $poin) {
        $cekPoinBulanan = PoinSalesTahunan::where('pegawai_nip', $pegawaiNip)
        ->where('tahun', $tahunAktif)
        ->count();

        if ($cekPoinBulanan == 0) {
            $totalPoin = $poin;
        } else {
            $poinTahunan = PoinSalesTahunan::where('pegawai_nip', $pegawaiNip)
            ->where('tahun', $tahunAktif)
            ->first();
            $jumlahPoin = $poinTahunan->total_poin;
            $totalPoin = $jumlahPoin + $poin;
        }

        return $totalPoin;
    }

    public function insentifBulanan($totalPoin) {
        $insentif = ($totalPoin * PoinSalesProvider::INSENTIF);

        return $insentif;
    }

    public function totalInsentifBulanan($totalPoin) {
        $insentif = $totalPoin * PoinSalesProvider::INSENTIF;

        if ($totalPoin >= 50) {
            $totalInsentif = $insentif + PoinSalesProvider::KOMISI_TAMBAHAN;
        } else {
            $totalInsentif = $insentif;
        }

        return $totalInsentif;
    }

    public function totalInsentifTahunan($totalPoin) {
        $insentif = ($totalPoin * PoinSalesProvider::INSENTIF);

        if ($totalPoin >= 600) {
            $totalInsentif = $insentif + PoinSalesProvider::KOMISI_TAMBAHAN_TAHUN;
        } else {
            $totalInsentif = $insentif;
        }

        return $totalInsentif;
    }

    public function insentifTahunan($totalPoin) {
        $insentif = ($totalPoin * PoinSalesProvider::INSENTIF);

        return $insentif;
    }
}
