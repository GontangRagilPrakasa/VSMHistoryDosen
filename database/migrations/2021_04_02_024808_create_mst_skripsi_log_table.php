<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstSkripsiLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_skripsi_log', function (Blueprint $table) {
            $table->bigIncrements('skripsi_log_id');
            $table->unsignedBigInteger('mahasiswa_id')->nullable();
            $table->unsignedBigInteger('dosen_id_log')->nullable();
            $table->string('mahasiswa_skripsi_name');
            $table->integer('status_skripsi');
            $table->text('skripsi_log');
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
        Schema::create('mst_skripsi_log', function (Blueprint $table) {
            //
        });
    }
}
