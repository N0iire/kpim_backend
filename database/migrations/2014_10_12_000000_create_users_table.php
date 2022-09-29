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
            $table->string('username')->unique();
            $table->string('api_token')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('nik')->unique();
            $table->string('nama_anggota');
            $table->text('alamat');
            $table->text('ttl');
            $table->string('pekerjaan');
            $table->date('tgl_daftar');
            $table->boolean('status')->default(1);
            $table->string('jabatan');
            $table->boolean('keanggotaan')->default(1);
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
