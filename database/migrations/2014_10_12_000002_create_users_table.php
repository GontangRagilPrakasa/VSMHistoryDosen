<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->unsignedBigInteger('role');
            $table->string('full_name');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->boolean('verification')->default(0)->comment('0:Belum Verifikasi, 1:Sudah Verifikasi');
            $table->timestamp('last_login')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamp('deleted_at')->nullable();
            $table->integer('deleted_by');
        });

        Schema::table('sys_users', function($table) {
            $table->foreign('role')->references('role_id')->on('sys_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_users');
    }
}
