<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSysMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_mahasiswa', function (Blueprint $table) {
            $table->string('mahasiswa_npm')->nullable();
            $table->string('mahasiswa_tempat_lahir')->nullable();
            $table->date('mahasiswa_tanggal_lahir')->nullable();
            $table->unsignedBigInteger('mahasiswa_fakultas')->nullable();
            $table->unsignedBigInteger('mahasiswa_prodi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_mahasiswa', function (Blueprint $table) {
            //
        });
    }
}
