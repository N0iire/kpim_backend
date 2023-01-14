<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPinjamansTable extends Migration
{
    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pinjamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pinjaman')->constrained('pinjamans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_barang')->constrained('barangs')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah');
            $table->double('sub_total');
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
        Schema::dropIfExists('detail_pinjamans');
    }
}
