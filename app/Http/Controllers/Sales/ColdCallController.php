<?php

namespace App\Http\Controllers\Sales;

use Carbon\Carbon;
use App\Models\Provinsi;
use App\Models\PoinSales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sales;
use App\Providers\JenisCallProvider;

class ColdCallController extends Controller
{

    //Menampilkan data customer
    public function index() {
        $data = [
            'title' => 'Cold Call Sales',
            'jenisCall' => JenisCallProvider::COLD_CALL,
        ];

        return view('sales.customer_call.cold_call', $data);
    }

    //Form tambah data pelanggan
    public function create() {
        $poinSales = PoinSales::where('nama', JenisCallProvider::COLD_CALL)->firstOrFail();
        $poinCall = $poinSales->poin;

        $data = [
            'title' => 'Form Tambah Customer Cold Call',
            'jenisCall' => JenisCallProvider::COLD_CALL,
            'poinCall' => $poinCall,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'today' => Carbon::now(),
            'coldCall' => JenisCallProvider::COLD_CALL,
            'warmCall' => JenisCallProvider::WARM_CALL,
        ];

        return view('sales.customer_call.form_tambah_customer', $data);
    }
}
