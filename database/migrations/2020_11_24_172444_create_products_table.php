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
            $table->string('name')->unique();
            $table->unsignedFloat('price');
            $table->unsignedSmallInteger('store_id')->nullable();
            $table->unsignedSmallInteger('company_id');
            $table->unsignedFloat('total_quantity');
            $table->unsignedFloat('used_quantity');
            $table->unsignedFloat('stored_quantity');
            $table->unsignedFloat('minimum_quantity')->nullable();
            $table->string('photo')->nullable();
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
