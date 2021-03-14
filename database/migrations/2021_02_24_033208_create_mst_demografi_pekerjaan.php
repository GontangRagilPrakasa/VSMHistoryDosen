<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstDemografiPekerjaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_demografi_pekerjaan', function (Blueprint $table) {
            $table->bigIncrements('pekerjaan_id');
            $table->unsignedBigInteger('periode_id');
            $table->unsignedBigInteger('job');
            $table->string('jumlah_pekerja_lk');
            $table->string('jumlah_pekerja_pr');
            $table->timestamps();
        });

        Schema::table('mst_demografi_pekerjaan', function($table) {
            $table->foreign('job')->references('job_id')->on('opt_jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_demografi_pekerjaan');
    }
}
