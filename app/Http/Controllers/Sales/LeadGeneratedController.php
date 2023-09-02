<?php

namespace App\Http\Controllers\Sales;

use Carbon\Carbon;
use App\Models\PoinSales;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\JenisCallProvider;

class LeadGeneratedController extends Controller
{
    //Menampilkan data customer
     public function index() {
        $data = [
            'title' => 'Lead Generated Sales',
            'jenisCall' => JenisCallProvider::LEAD_GENERATED,
        ];

        return view('sales.customer_call.lead_generated', $data);
    }

    //Form tambah data pelanggan
    public function create() {
        $poinSales = PoinSales::where('nama', JenisCallProvider::LEAD_GENERATED)->first();
        $poinCall = $poinSales->poin;

        $data = [
            'title' => 'Form Tambah Customer Lead Generated',
            'jenisCall' => JenisCallProvider::LEAD_GENERATED,
            'poinCall' => $poinCall,
            'tanggal' => Carbon::now()->format('Y-m-d'),
            'today' => Carbon::now(),
            'coldCall' => JenisCallProvider::COLD_CALL,
            'warmCall' => JenisCallProvider::WARM_CALL,
        ];

        return view('sales.customer_call.form_tambah_customer', $data);
    }
}
