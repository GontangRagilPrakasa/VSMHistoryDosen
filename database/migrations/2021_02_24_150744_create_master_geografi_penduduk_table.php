<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterGeografiPendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_demografi_penduduk', function (Blueprint $table) {
            $table->bigIncrements('penduduk_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('jumlah_penduduk_lk')->nullable();
            $table->string('jumlah_penduduk_pr')->nullable();
            $table->string('jumlah_penduduk_datang')->nullable();
            $table->string('jumlah_penduduk_pergi')->nullable();
            $table->string('jumlah_penduduk_total')->nullable();
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
        Schema::dropIfExists('mst_demografi_penduduk');
    }
}
