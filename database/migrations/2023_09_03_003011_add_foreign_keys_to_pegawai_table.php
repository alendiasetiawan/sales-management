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
        Schema::table('pegawai', function (Blueprint $table) {
            $table->foreign(['departemen_id'], 'pegawai_departemen_id')->references(['id'])->on('departemen')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['role_id'], 'pegawai_role_id')->references(['id'])->on('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropForeign('pegawai_departemen_id');
            $table->dropForeign('pegawai_role_id');
        });
    }
};
