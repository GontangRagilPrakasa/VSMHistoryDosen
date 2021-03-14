<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKesBersalinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_bersalin', function (Blueprint $table) {
            $table->bigIncrements('bersalin_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('bersalin_terdekat');
            $table->string('bersalin_jarak');
            $table->string('bersalin_waktu_tempuh');
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
        Schema::dropIfExists('mst_kes_bersalin');
    }
}
