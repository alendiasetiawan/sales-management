<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sales\LaporanTahunanController;
use App\Http\Controllers\SalesManager\DashboardController;
use App\Http\Controllers\SalesManager\LaporanBulananManagerController;
use App\Http\Controllers\SalesManager\LaporanPekananManagerController;

Route::group(['middleware'=> ['auth', 'salesmanager'], 'as' => 'salesmanager::'], function() {
    Route::prefix('salesmanager')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard_sales_manager');

        //---Menu : Laporan Sales---//
        Route::get('/laporan-sales-pekanan', [LaporanPekananManagerController::class, 'index']);
        Route::get('/laporan-sales-pekanan/pegawai', [LaporanPekananManagerController::class, 'show']);
        Route::get('/laporan-sales-bulanan', [LaporanBulananManagerController::class, 'index']);
        Route::get('/laporan-sales-tahunan', [LaporanTahunanController::class, 'index']);
    });
});
