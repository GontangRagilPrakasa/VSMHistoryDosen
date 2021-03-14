<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstKesPesertaBpjs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_peserta_bpjs', function (Blueprint $table) {
            $table->bigIncrements('peserta_bpjs_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('peserta_terdaftar_bpjs');
            $table->string('peserta_menggunakan_bpjs');
            $table->string('peserta_terdaftar_jamkesda');
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
        Schema::dropIfExists('mst_kes_peserta_bpjs');
    }
}
