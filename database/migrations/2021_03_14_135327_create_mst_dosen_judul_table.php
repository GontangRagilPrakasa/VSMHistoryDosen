<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstDosenJudulTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_dosen_judul', function (Blueprint $table) {
            $table->bigIncrements('dosen_judul_id');
            $table->unsignedBigInteger('dosen_id');
            $table->text('dosen_judul');
            $table->text('dosen_judul_processing');
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
        Schema::dropIfExists('mst_dosen_judul');
    }
}
