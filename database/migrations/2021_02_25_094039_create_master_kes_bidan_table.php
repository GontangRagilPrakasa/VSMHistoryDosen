<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKesBidanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_bidan', function (Blueprint $table) {
            $table->bigIncrements('bidan_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('bidan_terdekat');
            $table->string('bidan_jarak');
            $table->string('bidan_waktu_tempuh');
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
        Schema::dropIfExists('mst_kes_bidan');
    }
}
