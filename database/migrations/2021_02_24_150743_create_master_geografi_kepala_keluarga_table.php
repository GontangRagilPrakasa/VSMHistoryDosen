<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterGeografiKepalaKeluargaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_demografi_kk', function (Blueprint $table) {
            $table->bigIncrements('kk_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('jumlah_kk_lk');
            $table->string('jumlah_kk_pr');
            $table->string('jumlah_kk_miskin');
            $table->string('jumlah_kk_total');
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
        Schema::dropIfExists('mst_demografi_kk');
    }
}
