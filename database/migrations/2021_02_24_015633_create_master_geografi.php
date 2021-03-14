<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterGeografi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_geografi', function (Blueprint $table) {
            $table->bigIncrements('geografi_id');
            $table->unsignedBigInteger('periode_id');;
            $table->string('luas_geo_desa');
            $table->string('luas_geo_hutan');
            $table->unsignedBigInteger('jenis_geo');
            $table->timestamps();
        });

        Schema::table('master_geografi', function($table) {
            $table->foreign('jenis_geo')->references('geo_id')->on('opt_jenis_geografi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_geografi');
    }
}
