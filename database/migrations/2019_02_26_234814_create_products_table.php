<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',500);
            $table->string('slug',500);
            $table->longtext('details')->nullable();
            $table->longtext('description')->nullable();
            $table->integer('status')->default(0);
            $table->integer('highlight')->default(0);
            $table->string('image',500);
            $table->string('reference',200)->nullable();
            $table->string('product_weight',200)->nullable();
            $table->string('product_size',200)->nullable();
            $table->string('colors',500)->nullable();
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
        Schema::dropIfExists('products');
    }
}
