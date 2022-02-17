<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fullname');
            $table->string('username');
            $table->integer('kelas');
            $table->string('nisn');
            $table->string('email')->nullable();
            $table->string('telp')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('otp');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->integer('roles')->default(0);
            $table->integer('gender')->default(0);
            $table->float('saldo')->default(0);
            $table->string('thumbnail');
            $table->integer('status')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
