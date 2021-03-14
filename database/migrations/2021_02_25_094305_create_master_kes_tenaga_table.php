<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKesTenagaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_tenaga', function (Blueprint $table) {
            $table->bigIncrements('kes_tenaga_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('tenaga_bidan_status');
            $table->string('tenaga_bidan_jumlah');
            $table->string('tenaga_dokter_status');
            $table->string('tenaga_dokter_jumlah');
            $table->string('tenaga_lainnya_status');
            $table->string('tenaga_lainnya_jumlah');
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
        Schema::dropIfExists('mst_kes_tenaga');
    }
}
