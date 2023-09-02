<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $guarded = [];

    public function sales(): HasMany
    {
        return $this->hasMany(Sales::class, 'pegawai_nip', 'nip');
    }

    public function poinSalesPekanan(): HasMany
    {
        return $this->hasMany(PoinSalesPekanan::class, 'pegawai_nip', 'nip');
    }

    //Looping data pegawai dengan poin yang didapatkan per pekan
    public static function poinPegawaiPerPekan($pekan, $bulan, $tahun) {
        return Pegawai::join('sales', 'pegawai.nip', 'sales.pegawai_nip')
        ->join('poin_sales_pekanan', 'pegawai.nip', 'poin_sales_pekanan.pegawai_nip')
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->orderBy('poin_sales_pekanan.total_poin', 'desc')
        ->sum('poin');
    }
}
