<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductToppingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_topping', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('topping_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('topping_id')->references('id')->on('toppings');
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('product_topping');
    }
}
