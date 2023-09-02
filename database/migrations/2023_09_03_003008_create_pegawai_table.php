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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nip', 30)->nullable()->unique('nip');
            $table->string('nama_pegawai', 100)->nullable();
            $table->enum('jk', ['Laki-Laki', 'Perempuan'])->nullable();
            $table->integer('prefix_hp')->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->integer('departemen_id')->nullable();
            $table->integer('role_id')->nullable()->index('role_id');
            $table->timestamps();

            $table->index(['departemen_id', 'nip'], 'pegawai_index_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};
