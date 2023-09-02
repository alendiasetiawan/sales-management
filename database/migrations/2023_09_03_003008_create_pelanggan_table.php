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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('kode', 30)->nullable()->unique('kode');
            $table->string('nama', 200)->nullable();
            $table->enum('jk', ['Laki-Laki', 'Perempuan'])->nullable();
            $table->string('alamat', 1000)->nullable();
            $table->integer('provinsi_id')->nullable();
            $table->integer('kabupaten_id')->nullable();
            $table->integer('kecamatan_id')->nullable();
            $table->integer('prefix_hp')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->string('pegawai_nip', 30)->nullable()->index('pegawai_nip');
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
        Schema::dropIfExists('pelanggan');
    }
};
