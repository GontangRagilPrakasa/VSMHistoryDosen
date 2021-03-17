<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('mahasiswa_id');
            $table->unsignedBigInteger('users_id');
            $table->string('mahasiswa_name');
            $table->string('mahasiswa_jk');
            $table->string('mahasiswa_telp');
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
        Schema::dropIfExists('sys_mahasiwa');
    }
}
