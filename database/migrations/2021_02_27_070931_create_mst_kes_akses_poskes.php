<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstKesAksesPoskes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_akses_poskes', function (Blueprint $table) {
            $table->bigIncrements('poskes_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('poskes_terdekat');
            $table->string('poskes_jarak');
            $table->string('poskes_waktu_tempuh');
            $table->string('poskes_fungsi');
            $table->string('poskes_rumah_singgah');
            $table->string('posyandu_terdekat');
            $table->string('posyandu_satu_bulan');
            $table->string('posyandu_dua_bulan');
            $table->string('posyandu_fungsi');
            $table->string('posyandu_sumber_dana');
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
        Schema::dropIfExists('mst_kes_akses_poskes');
    }
}
