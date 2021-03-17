<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_dosen', function (Blueprint $table) {
            $table->bigIncrements('dosen_id');
            $table->unsignedBigInteger('users_id');
            $table->string('dosen_name');
            $table->string('dosen_jk');
            $table->string('dosen_telp');
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
        Schema::dropIfExists('sys_dosen');
    }
}
