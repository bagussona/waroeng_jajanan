<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->integer('total_laba_prediksi')->default(0);
            $table->integer('total_transaksi')->default(0);
            $table->integer('total_pendapatan_usaha')->default(0);
            $table->integer('total_pendapatan_masuk')->default(0);
            $table->integer('total_pendapatan_hutang')->default(0);
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
        Schema::dropIfExists('reports');
    }
}
