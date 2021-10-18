<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpbCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spb_carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('author')->default(0)->nullable();
            $table->string('keterangan')->default(0)->nullable();
            $table->string('name')->default(0)->nullable();
            $table->string('slug')->default(0)->nullable();
            $table->text('description')->nullable();
            $table->string('supplier')->default(0)->nullable();
            $table->string('category')->default(0)->nullable();
            $table->integer('price')->default(0)->nullable();
            $table->integer('stock')->default(0)->nullable();
            $table->string('image')->default(0)->nullable();
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
        Schema::dropIfExists('spb_carts');
    }
}
