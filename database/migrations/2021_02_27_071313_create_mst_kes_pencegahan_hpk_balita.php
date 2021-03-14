<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstKesPencegahanHpkBalita extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_pencegahan_hpk_balita', function (Blueprint $table) {
            $table->bigIncrements('peserta_bpjs_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('jumlah_balita');
            $table->string('jumlah_balita_ikut_paud');
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
        Schema::dropIfExists('mst_kes_pencegahan_hpk_balita');
    }
}
