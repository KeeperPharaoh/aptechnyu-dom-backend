<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_id');

            $table->index('category_id', 'category_product_category_idx');
            $table->index('product_id', 'category_product_product_idx');

            $table->foreign('category_id', 'category_product_category_fk')
                  ->on('categories')
                  ->references('id')
                  ->onDelete('cascade');
            $table->foreign('product_id', 'category_product_product_fk')
                  ->on('products')
                  ->references('id')
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

        Schema::dropIfExists('category_products');
    }
}
