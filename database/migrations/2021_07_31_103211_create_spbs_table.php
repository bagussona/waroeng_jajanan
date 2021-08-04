<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spbs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('author');
            $table->string('keterangan');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('supplier');
            $table->string('category');
            $table->integer('price');
            $table->integer('stock');
            $table->string('image');
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
        Schema::dropIfExists('spbs');
    }
}
