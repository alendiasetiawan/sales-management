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
        Schema::table('poin_sales_pekanan', function (Blueprint $table) {
            $table->foreign(['pegawai_nip'], 'poin_pekanan_pegawai_nip')->references(['nip'])->on('pegawai');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poin_sales_pekanan', function (Blueprint $table) {
            $table->dropForeign('poin_pekanan_pegawai_nip');
        });
    }
};
