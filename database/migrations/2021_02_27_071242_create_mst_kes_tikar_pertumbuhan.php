<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstKesTikarPertumbuhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_tikar_pertumbuhan', function (Blueprint $table) {
            $table->bigIncrements('pertumbuhan_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('panjang_baduta_normal');
            $table->string('panjang_baduta_resiko');
            $table->string('panjang_baduta_terdeteksi');
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
        Schema::dropIfExists('mst_kes_tikar_pertumbuhan');
    }
}
