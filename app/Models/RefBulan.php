<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RefBulan extends Model
{
    use HasFactory;

    protected $table = 'ref_bulan';
    protected $guarded = [];

    public function sales(): HasMany
    {
        return $this->hasMany(Sales::class, 'bulan', 'bulan');
    }
}
