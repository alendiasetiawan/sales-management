<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('pelanggan_kode', 30)->nullable();
            $table->string('pegawai_nip', 30)->nullable()->index('sales_pegawai_nip');
            $table->integer('unit')->nullable();
            $table->string('satuan', 10)->nullable();
            $table->float('harga_satuan', 10, 0)->nullable();
            $table->float('harga_total', 10, 0)->nullable();
            $table->date('tanggal')->nullable();
            $table->enum('status_sales', ['Cold Call', 'Warm Call', 'Lead Generated', 'Sales Closing'])->nullable();
            $table->integer('pekan')->nullable();
            $table->string('bulan', 30)->nullable();
            $table->integer('tahun')->nullable();
            $table->float('poin', 10, 0)->nullable();
            $table->timestamps();

            $table->index(['pelanggan_kode', 'pegawai_nip'], 'sales_index_1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
