<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->integer('product_price');
            $table->integer('product_quantity');
            $table->foreignId('brand_id')->references('id')->on('brands');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->string('product_img');
            $table->string('product_sizes')->nullable();
            $table->string('product_colors')->nullable();
            $table->text('short_description')->nullable();
            $table->text('product_details')->nullable();
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
};
