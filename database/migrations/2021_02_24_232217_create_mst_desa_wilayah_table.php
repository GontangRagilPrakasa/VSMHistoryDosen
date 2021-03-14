<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstDesaWilayahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_desa_wilayah', function (Blueprint $table) {
            $table->bigIncrements('desa_wilayah_id');
            $table->unsignedInteger('periode_id');
            $table->text('alamat_deswil')->nullable();
            $table->string('gedung_deswil')->nullable();
            $table->string('latitude_deswil')->nullable();
            $table->string('longitude_deswil')->nullable();
            $table->boolean('peta_deswil')->default(0)->comment('0:Belum Ada, 1:Sudah Ada');
            $table->string('no_telp_deswil')->nullable();
            $table->string('email_deswil')->nullable();
            $table->string('facebook_deswil')->nullable();
            $table->string('instagram_deswil')->nullable();
            $table->string('twitter_deswil')->nullable();
            $table->string('web_deswil')->nullable();
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
        Schema::dropIfExists('mst_desa_wilayah');
    }
}
