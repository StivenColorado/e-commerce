<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingCartsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('shopping_carts')) {
            Schema::create('shopping_carts', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('id_user')->unsigned(); // Cambiado a bigInteger
                $table->bigInteger('product_id')->unsigned(); // Cambiado a bigInteger
                $table->integer('quantity')->default(0)->unsigned();
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            });
        }
    }



    public function down()
    {
        Schema::dropIfExists('shopping_carts');
    }
}
