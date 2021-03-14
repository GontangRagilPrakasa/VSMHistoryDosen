<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstKesPencegahanHpkBumil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_pencegahan_hpk_bumil', function (Blueprint $table) {
            $table->bigIncrements('hpk_bumil_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('bumil_cek_4x');
            $table->string('bumil_pil_fe');
            $table->string('bumil_nifas_3x');
            $table->string('bumil_konseling_gizi');
            $table->string('bumil_kek');
            $table->string('bumil_kek_kunjungan');
            $table->string('bumil_resti');
            $table->string('bumil_resti_kunjungan');
            $table->string('bumil_minum_aman');
            $table->string('bumil_jamban_layak');
            $table->string('bumil_jamkes');
            $table->string('jumlah_bumil_konvergensi');
            $table->string('jumlah_bumil_konvergensi_seharusnya');
            $table->string('tingkat_bumil_konvergensi');
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
        Schema::dropIfExists('mst_kes_pencegahan_hpk_bumil');
    }
}
