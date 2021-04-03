<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DosenPengampuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_dosen_mengampu', function (Blueprint $table) {
            $table->unsignedBigInteger('dosen_id_2')->nullable();
            $table->unsignedBigInteger('dosen_judul_id_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mst_dosen_mengampu', function (Blueprint $table) {
            //
        });
    }
}
