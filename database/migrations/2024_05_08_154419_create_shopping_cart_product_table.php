<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shopping_cart_product', function (Blueprint $table) {
            $table->unsignedBigInteger('shopping_cart_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(0); // Asegúrate de que haya un valor predeterminado
            $table->timestamps();

            // Definir claves foráneas y restricciones
            $table->foreign('shopping_cart_id')->references('id')->on('shopping_carts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('shopping_cart_product');
    }
};
