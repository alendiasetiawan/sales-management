<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PoinSales extends Model
{
    use HasFactory;


    protected $table = 'poin_sales';
    protected $guarded =[];

    public function sales(): HasMany
    {
        return $this->hasMany(Sales::class, 'status_sales', 'nama');
    }

    //looping data sales tahunan
    public static function salesTahunan($pegawaiNip, $tahun) {
        return PoinSales::with([
            'sales' => function($query) use($pegawaiNip, $tahun) {
                $query->where('pegawai_nip', $pegawaiNip)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }

    //looping data sales bulanan
    public static function salesBulananManager($bulan, $tahun) {
        return PoinSales::with([
            'sales' => function($query) use($bulan, $tahun) {
                $query->where('bulan', $bulan)
                ->where('tahun', $tahun);
            }
        ])
        ->get();
    }

    //looping data sales harian
    public static function salesHarianManager($tanggal) {
        return PoinSales::with([
            'sales' => function($query) use($tanggal) {
                $query->where('tanggal', $tanggal);
            }
        ])
        ->get();
    }
}
