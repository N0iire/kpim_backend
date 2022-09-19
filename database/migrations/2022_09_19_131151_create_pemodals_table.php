<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemodalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemodals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->string('nama_pemodal');
            $table->date('tgl_bayar');
            $table->double('nominal_modal');
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
        Schema::dropIfExists('pemodals');
    }
}
