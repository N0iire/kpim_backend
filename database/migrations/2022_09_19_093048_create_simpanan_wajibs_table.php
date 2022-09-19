<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpananWajibsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simpanan_wajibs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->date('tgl_bayar');
            $table->double('nominal_bayar');
            $table->boolean('status_simp_wajib');
            $table->text('ket');
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
        Schema::dropIfExists('simpanan_wajibs');
    }
}
