<?php

namespace App\Http\Controllers\Sales;

use Carbon\Carbon;
use App\Models\PoinSales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\JenisCallProvider;

class SalesClosingController extends Controller
{
    //Menampilkan data customer
    public function index() {
        $data = [
            'title' => 'Sales Closing',
            'jenisCall' => JenisCallProvider::SALES_CLOSING,
        ];

        return view('sales.customer_call.sales_closing', $data);
    }

    //Form tambah data pelanggan
    public function create() {
        $poinSales = PoinSales::where('nama', JenisCallProvider::SALES_CLOSING)->first();
        $poinCall = $poinSales->poin;

        $data = [
            'title' => 'Form Tambah Customer Sales Closing',
            'jenisCall' => JenisCallProvider::SALES_CLOSING,
            'poinCall' => $poinCall,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'today' => Carbon::now(),
            'coldCall' => JenisCallProvider::COLD_CALL,
            'warmCall' => JenisCallProvider::WARM_CALL,
        ];

        return view('sales.customer_call.form_sales_closing', $data);
    }
}
