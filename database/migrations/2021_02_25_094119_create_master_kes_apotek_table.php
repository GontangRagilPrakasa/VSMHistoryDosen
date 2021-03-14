<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKesApotekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_apotek', function (Blueprint $table) {
            $table->bigIncrements('apotek_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('apotek_terdekat');
            $table->string('apotek_jarak');
            $table->string('apotek_waktu_tempuh');
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
        Schema::dropIfExists('mst_kes_apotek');
    }
}
