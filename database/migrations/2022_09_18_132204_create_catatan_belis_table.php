<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatatanBelisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catatan_belis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->string('no_transaksi')->nullable();
            $table->string('supplier');
            $table->date('tgl_pembelian');
            $table->double('total_pembelian');
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
        Schema::dropIfExists('catatan_belis');
    }
}
