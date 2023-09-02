<?php

namespace App\Services;

use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PelangganService {

    //Rumus membuat kode pelanggan
    public function kodePelanggan($kabupatenId) {
        $jumlahPelanggan = Pelanggan::count();
        $urutan = $jumlahPelanggan + 1;
        $kodePelanggan = $kabupatenId.$urutan;

        return $kodePelanggan;
    }

}
