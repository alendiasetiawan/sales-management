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
        Schema::table('sales', function (Blueprint $table) {
            $table->foreign(['pegawai_nip'], 'sales_pegawai_nip')->references(['nip'])->on('pegawai');
            $table->foreign(['pelanggan_kode'], 'sales_pelanggan_kode')->references(['kode'])->on('pelanggan')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign('sales_pegawai_nip');
            $table->dropForeign('sales_pelanggan_kode');
        });
    }
};
