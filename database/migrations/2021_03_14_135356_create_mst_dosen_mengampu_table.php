<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstDosenMengampuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_dosen_mengampu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dosen_id');
            $table->unsignedBigInteger('dosen_judul_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('approval')->default(0);
            $table->timestamps();
            $table->timestamps('start_mengampu')->nullable();
            $table->timestamps('selesai_mengampu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_dosen_mengampu');
    }
}
