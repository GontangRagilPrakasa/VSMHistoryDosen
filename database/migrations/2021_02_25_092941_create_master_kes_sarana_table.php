<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKesSaranaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_sarana', function (Blueprint $table) {
            $table->bigIncrements('sarkes_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('sarkes_terdekat');
            $table->string('sarkes_jarak');
            $table->string('sarkes_waktu_tempuh');
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
        Schema::dropIfExists('mst_kes_sarana');
    }
}
