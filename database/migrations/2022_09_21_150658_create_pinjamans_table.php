<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->date('tgl_pinjaman');
            $table->double('total_pinjaman');
            $table->double('nominal_cicilan');
            $table->integer('durasi_cicilan');
            $table->date('jatuh_tempo');
            $table->double('sisa_cicilan');
            $table->boolean('status');
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
        Schema::dropIfExists('pinjamans');
    }
}
