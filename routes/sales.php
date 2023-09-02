<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sales\ColdCallController;
use App\Http\Controllers\Sales\WarmCallController;
use App\Http\Controllers\Sales\DashboardController;
use App\Http\Controllers\Sales\SalesClosingController;
use App\Http\Controllers\Sales\LeadGeneratedController;
use App\Http\Controllers\Sales\LaporanBulananController;
use App\Http\Controllers\Sales\LaporanPekananController;
use App\Http\Controllers\Sales\LaporanTahunanController;

Route::group(['middleware'=> ['auth', 'sales'], 'as' => 'sales::'], function() {
    Route::prefix('sales')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard_sales');

        //---Menu : Customer Call---//
        Route::get('/cold-call', [ColdCallController::class, 'index']);
        Route::get('/cold-call/tambah', [ColdCallController::class, 'create']);

        Route::get('/warm-call', [WarmCallController::class, 'index']);
        Route::get('/warm-call/tambah', [WarmCallController::class, 'create']);

        Route::get('/lead-generated', [LeadGeneratedController::class, 'index']);
        Route::get('/lead-generated/tambah', [LeadGeneratedController::class, 'create']);

        Route::get('/sales-closing', [SalesClosingController::class, 'index']);
        Route::get('/sales-closing/tambah', [SalesClosingController::class, 'create']);

        //---Menu : Laporan Sales---//
        Route::get('/laporan-sales-pekanan', [LaporanPekananController::class, 'index']);
        Route::get('/laporan-sales-bulanan', [LaporanBulananController::class, 'index']);
        Route::get('/laporan-sales-tahunan', [LaporanTahunanController::class, 'index']);
    });
});
