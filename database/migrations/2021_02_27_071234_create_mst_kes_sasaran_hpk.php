<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstKesSasaranHpk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_sasaran_hpk', function (Blueprint $table) {
            $table->bigIncrements('hpk_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('jumlah_hpk');
            $table->string('jumlah_ibu_hamil');
            $table->string('jumlah_baduta');
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
        Schema::dropIfExists('mst_kes_sasaran_hpk');
    }
}
