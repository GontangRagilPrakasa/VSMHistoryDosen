<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKesPuskesmasInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_puskesmas_inap', function (Blueprint $table) {
            $table->bigIncrements('puskesmas_inap_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('puskesmas_inap_terdekat');
            $table->string('puskesmas_inap_jarak');
            $table->string('puskesmas_inap_waktu_tempuh');
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
        Schema::dropIfExists('mst_kes_puskesmas_inap');
    }
}
