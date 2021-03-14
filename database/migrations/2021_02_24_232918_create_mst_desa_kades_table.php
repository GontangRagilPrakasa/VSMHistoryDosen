<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstDesaKadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_desa_kades', function (Blueprint $table) {
            $table->bigIncrements('kades_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('nama_kades');
            $table->string('jk_kades');
            $table->string('no_telp_kades');
            $table->unsignedBigInteger('pendidikan_kades');
            $table->string('masa_jabatan_kades');
            $table->unsignedBigInteger('pendidikan_sekdes');
            $table->string('masa_jabatan_sekdes');
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
        Schema::dropIfExists('mst_desa_kades');
    }
}
