<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_admin', function (Blueprint $table) {
            $table->bigIncrements('admin_id');
            $table->unsignedBigInteger('user');
            $table->string('informant_name');
            $table->unsignedBigInteger('informant_position');
            $table->string('informant_phone');
            $table->date('informant_birthday');
            $table->unsignedBigInteger('gender');
            $table->char('desa', 10);
            $table->timestamps();
        });

        Schema::table('sys_admin', function($table) {
            $table->foreign('informant_position')->references('position_id')->on('opt_position');
            $table->foreign('user')->references('user_id')->on('sys_users');
            $table->foreign('gender')->references('gender_id')->on('opt_gender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_admin');
    }
}
