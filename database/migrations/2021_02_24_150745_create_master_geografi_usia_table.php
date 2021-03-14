<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterGeografiUsiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_demografi_usia', function (Blueprint $table) {
            $table->bigIncrements('usia_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('jumlah_usia_1_tahun');
            $table->string('jumlah_usia_4_tahun');
            $table->string('jumlah_usia_14_tahun');
            $table->string('jumlah_usia_39_tahun');
            $table->string('jumlah_usia_64_tahun');
            $table->string('jumlah_usia_65_tahun');
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
        Schema::dropIfExists('mst_demografi_usia');
    }
}
