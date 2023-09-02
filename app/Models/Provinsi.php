<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provinsi extends Model
{
    use HasFactory;

    protected $table = 'provinsi';
    protected $guarded =[];

    public function pelanggan(): HasMany
    {
        return $this->hasMany(Pelanggan::class, 'provinsi_id', 'id');
    }
}
