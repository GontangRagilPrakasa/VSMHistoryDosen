<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstIdmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_idm', function (Blueprint $table) {
            $table->bigIncrements('idm_id');
            $table->unsignedBigInteger('periode_id');
            $table->boolean('verifikasi_kec')->default(0)->comment('0:Belum Verifikasi, 1:Sudah Verifikasi');
            $table->boolean('verifikasi_kab')->default(0)->comment('0:Belum Verifikasi, 1:Sudah Verifikasi');
            $table->boolean('verifikasi_prov')->default(0)->comment('0:Belum Verifikasi, 1:Sudah Verifikasi');
            $table->boolean('is_verify')->default(0)->comment('0:Belum Verifikasi, 1:Sudah Verifikasi');
            $table->decimal('iks_value', 5,2);
            $table->decimal('ike_value', 5,2);
            $table->decimal('ikl_value', 5,2);
            $table->decimal('idm_value', 5,2);
            $table->integer('idm_status');
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
        Schema::dropIfExists('mst_idm');
    }
}
