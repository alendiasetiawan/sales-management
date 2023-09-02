<?php

namespace App\Http\Controllers\SalesManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaporanBulananManagerController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Laporan Sales Bulanan'
        ];

        return view('sales_manager.laporan.laporan_sales_bulanan', $data);
    }
}
