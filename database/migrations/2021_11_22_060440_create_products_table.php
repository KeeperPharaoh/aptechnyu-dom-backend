<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table
                ->unsignedBigInteger('subcategory_id')
                ->nullable();
            $table->foreign('subcategory_id')
                  ->references('id')
                  ->on('categories')
                  ->onUpdate('cascade')
                  ->onDelete('cascade')
            ;
            $table->string('title');
            $table->string('subtitle');
            $table->string('article');
            $table->string('image');
            $table->integer('price');
            $table->integer('old_price')->nullable();
            $table->string('country');
            $table->string('manufacturer')->nullable();
            $table->text('instruction')->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->nullable();
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

        Schema::dropIfExists('products');
    }
}
