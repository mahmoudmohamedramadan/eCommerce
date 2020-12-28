<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedSmallInteger('age');
            $table->string('national_id')->unique();
            $table->string('phone')->unique();
            $table->string('address');
            $table->unsignedSmallInteger('salary');
            $table->unsignedSmallInteger('per')->comment('1:week, 2:month, 3:year');
            $table->unsignedSmallInteger('store_id')->comment('0:null');
            $table->boolean('worker_permission')->comment('0:null, 1:manager, 2:worker');
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
        Schema::dropIfExists('workers');
    }
}
