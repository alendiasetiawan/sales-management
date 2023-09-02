<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PoinSalesPekanan extends Model
{
    use HasFactory;

    protected $table = 'poin_sales_pekanan';
    protected $guarded = [];

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_nip', 'nip');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sales::class, 'pegawai_nip', 'pegawai_nip');
    }

    public static function poinPekanan($pekan, $bulan, $tahun) {
        return PoinSalesPekanan::with([
            'pegawai' => function ($query) {
                $query->where('role_id', 1)
                ->where('departemen_id', 1);
            },
            'sales' => function ($query) use($pekan, $bulan, $tahun) {
                $query->where('pekan', $pekan)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun);
            }
        ])
        ->where('pekan', $pekan)
        ->where('bulan', $bulan)
        ->where('tahun', $tahun)
        ->orderBy('total_poin', 'desc')
        ->limit(5)
        ->get();
    }
}
