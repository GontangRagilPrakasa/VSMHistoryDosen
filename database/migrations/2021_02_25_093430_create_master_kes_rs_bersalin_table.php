<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKesRsBersalinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_rs_bersalin', function (Blueprint $table) {
            $table->bigIncrements('rs_bersalin_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('rs_bersalin_terdekat');
            $table->string('rs_bersalin_jarak');
            $table->string('rs_bersalin_waktu_tempuh');
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
        Schema::dropIfExists('mst_kes_rs_bersalin');
    }
}
