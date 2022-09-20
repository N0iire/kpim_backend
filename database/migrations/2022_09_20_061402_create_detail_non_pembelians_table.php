<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailNonPembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_non_pembelians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengeluaran');
            $table->string('nama_transaksi');
            $table->date('tgl_transaksi');
            $table->double('nominal_transaksi');
            $table->text('keterangan');
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
        Schema::dropIfExists('detail_non_pembelians');
    }
}
