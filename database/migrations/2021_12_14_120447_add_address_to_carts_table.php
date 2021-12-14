<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressToCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('city');
            $table->string('house');
            $table->string('apartment');
            $table->string('porch');
            $table->string('floor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('phone_number');
            $table->dropColumn('email');
            $table->dropColumn('city');
            $table->dropColumn('house');
            $table->dropColumn('apartment');
            $table->dropColumn('porch');
            $table->dropColumn('floor');
        });
    }
}
