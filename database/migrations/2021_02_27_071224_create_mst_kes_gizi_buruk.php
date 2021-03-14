<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstKesGiziBuruk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_gizi_buruk', function (Blueprint $table) {
            $table->bigIncrements('gizi_buruk_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('kematian_ibu_melahirkan');
            $table->string('kematian_ibu_melahirkan_jumlah');
            $table->string('kematian_balita');
            $table->string('kematian_balita_jumlah');
            $table->string('kematian_basata');
            $table->string('kematian_basata_jumlah');
            $table->string('gizi_buruk');
            $table->string('gizi_buruk_jumlah');
            $table->string('kejadian_luar_biasa');
            $table->string('kejadian_luar_biasa_jumlah');
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
        Schema::dropIfExists('mst_kes_gizi_buruk');
    }
}
