<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKesDrPraktekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_dr_praktek', function (Blueprint $table) {
            $table->bigIncrements('dr_praktek_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('dr_praktek_terdekat');
            $table->string('dr_praktek_jarak');
            $table->string('dr_praktek_waktu_tempuh');
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
        Schema::dropIfExists('mst_kes_dr_praktek');
    }
}
