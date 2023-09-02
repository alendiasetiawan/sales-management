<?php

namespace App\Models;

use App\Providers\JenisCallProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RefPekan extends Model
{
    use HasFactory;

    protected $table = 'ref_pekan';
    protected $guarded = [];

    public function sales(): HasMany
    {
        return $this->hasMany(Sales::class, 'pekan', 'pekan');
    }

    //Loop data cold call per bulan
    public static function coldCallPerBulan($pegawaiNip, $bulan, $tahun) {
        return RefPekan::with([
            'sales' => function ($query) use($bulan, $pegawaiNip, $tahun) {
                $query->where('status_sales', JenisCallProvider::COLD_CALL)
                ->where('pegawai_nip', $pegawaiNip)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }

    //Loop data warm call per bulan
    public static function warmCallPerBulan($pegawaiNip, $bulan, $tahun) {
        return RefPekan::with([
            'sales' => function ($query) use($bulan, $pegawaiNip, $tahun) {
                $query->where('status_sales', JenisCallProvider::WARM_CALL)
                ->where('pegawai_nip', $pegawaiNip)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }

    //Loop data lead generated per bulan
    public static function leadGeneratedPerBulan($pegawaiNip, $bulan, $tahun) {
        return RefPekan::with([
            'sales' => function ($query) use($bulan, $pegawaiNip, $tahun) {
                $query->where('status_sales', JenisCallProvider::LEAD_GENERATED)
                ->where('pegawai_nip', $pegawaiNip)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }

    //Loop data sales closing per bulan
    public static function salesClosingPerBulan($pegawaiNip, $bulan, $tahun) {
        return RefPekan::with([
            'sales' => function ($query) use($bulan, $pegawaiNip, $tahun) {
                $query->where('status_sales', JenisCallProvider::SALES_CLOSING)
                ->where('pegawai_nip', $pegawaiNip)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }

    //Loop data cold call per bulan MANAGER
    public static function coldCallPerBulanManager($bulan, $tahun) {
        return RefPekan::with([
            'sales' => function ($query) use($bulan, $tahun) {
                $query->where('status_sales', JenisCallProvider::COLD_CALL)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }

    //Loop data warm call per bulan MANAGER
    public static function warmCallPerBulanManager($bulan, $tahun) {
        return RefPekan::with([
            'sales' => function ($query) use($bulan, $tahun) {
                $query->where('status_sales', JenisCallProvider::WARM_CALL)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }

    //Loop data lead generated per bulan MANAGER
    public static function leadGeneratedPerBulanManager($bulan, $tahun) {
        return RefPekan::with([
            'sales' => function ($query) use($bulan, $tahun) {
                $query->where('status_sales', JenisCallProvider::LEAD_GENERATED)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }

    //Loop data sales closing per bulan MANAGER
    public static function salesClosingPerBulanManager($bulan, $tahun) {
        return RefPekan::with([
            'sales' => function ($query) use($bulan, $tahun) {
                $query->where('status_sales', JenisCallProvider::SALES_CLOSING)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }
}
