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
        Schema::create('poin_sales_tahunan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('pegawai_nip', 30)->nullable()->index('poin_sales_tahunan_index_5');
            $table->integer('tahun')->nullable();
            $table->float('total_poin', 10, 0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poin_sales_tahunan');
    }
};
