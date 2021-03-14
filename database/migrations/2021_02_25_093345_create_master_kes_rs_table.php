<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKesRsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_rs', function (Blueprint $table) {
            $table->bigIncrements('rs_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('rs_terdekat');
            $table->string('rs_jarak');
            $table->string('rs_waktu_tempuh');
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
        Schema::dropIfExists('mst_kes_rs');
    }
}
