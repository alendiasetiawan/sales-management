<?php

namespace App\Http\Controllers\Sales;

use Carbon\Carbon;
use App\Models\PoinSales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\JenisCallProvider;

class WarmCallController extends Controller
{
    //Daftar log customer
    public function index() {
        $data = [
            'title' => 'Warm Call Sales',
            'jenisCall' => 'Warm Call',
        ];

        return view('sales.customer_call.warm_call', $data);
    }

    //Form tambah data pelanggan
    public function create() {
        $poinSales = PoinSales::where('nama', JenisCallProvider::WARM_CALL)->first();
        $poinCall = $poinSales->poin;

        $data = [
            'title' => 'Form Tambah Customer Warm Call',
            'jenisCall' => JenisCallProvider::WARM_CALL,
            'poinCall' => $poinCall,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'today' => Carbon::now(),
            'coldCall' => JenisCallProvider::COLD_CALL,
            'warmCall' => JenisCallProvider::WARM_CALL,
        ];

        return view('sales.customer_call.form_tambah_customer', $data);
    }
}
