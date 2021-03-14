<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstOrganisasiDesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_desa_organisasi', function (Blueprint $table) {
            $table->bigIncrements('desa_organisasi_id');
            $table->unsignedBigInteger('periode_id');
            $table->unsignedBigInteger('organisasi');
            $table->string('jumlah_lk');
            $table->string('jumlah_pr');
            $table->timestamps();
        });

        Schema::table('mst_desa_organisasi', function($table) {
            $table->foreign('organisasi')->references('organisasi_id')->on('opt_organisasi_desa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_desa_organisasi');
    }
}
