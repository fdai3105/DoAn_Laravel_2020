<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name');
            $table->string('desc');
            $table->string('image');
            $table->string('price');
            $table->integer('vote');

            $table->integer('product_brands_id');
            $table->foreign('product_brands_id')->references('id')
                ->on('product_brands')
                ->onDelete('cascade');
            $table->integer('categories_id');
            $table->foreign('categories_id')->references('id')
                ->on('categories')
                ->onDelete('cascade');
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
