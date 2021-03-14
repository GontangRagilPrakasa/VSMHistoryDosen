<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstKesPencegahanHpkBaduta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_kes_pencegahan_hpk_baduta', function (Blueprint $table) {
            $table->bigIncrements('hpk_baduta_id');
            $table->unsignedBigInteger('periode_id');
            $table->string('baduta_imunisasi');
            $table->string('baduta_timbang_rutin');
            $table->string('baduta_ukur_panjang');
            $table->string('pengasuh_lk_konseling');
            $table->string('pengasuh_pr_konseling');
            $table->string('kunjungan_gizi_buruk');
            $table->string('kunjungan_stunting');
            $table->string('baduta_minum_aman');
            $table->string('baduta_jamban_layak');
            $table->string('baduta_jamkes');
            $table->string('baduta_akta_lahir');
            $table->string('pengasuh_ikut_parenting');
            $table->string('jumlah_baduta_konvergensi');
            $table->string('jumlah_baduta_konvergensi_seharusnya');
            $table->string('tingkat_baduta_konvergensi');
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
        Schema::dropIfExists('mst_kes_pencegahan_hpk_baduta');
    }
}
