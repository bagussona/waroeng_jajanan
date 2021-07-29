<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_histories', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('name')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('pcs')->nullable();
            // $table->integer('Debit')->nullable()->default(0);
            // $table->integer('Credit')->nullable()->default(0);
            $table->integer('subtotal')->nullable()->default(0);
            $table->string('user_id');
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
        Schema::dropIfExists('order_histories');
    }
}
