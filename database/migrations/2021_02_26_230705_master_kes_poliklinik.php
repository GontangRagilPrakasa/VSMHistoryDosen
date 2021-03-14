<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MasterKesPoliklinik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_poliklinik', function (Blueprint $table) {
            $table->bigIncrements('poliklinik_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('poliklinik_terdekat');
            $table->string('poliklinik_jarak');
            $table->string('poliklinik_waktu_tempuh');
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
        Schema::dropIfExists('mst_kes_poliklinik');
    }
}
