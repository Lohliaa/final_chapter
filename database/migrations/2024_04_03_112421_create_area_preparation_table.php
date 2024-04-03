<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaPreparationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_preparation', function (Blueprint $table) {
            $table->id();
            $table->string('kav')->nullable();
            $table->string('bagian')->nullable();
            $table->string('area_store')->nullable();
            $table->string('material')->nullable();
            $table->string('warna')->nullable();
            $table->string('qty_board')->nullable();
            $table->string('publish')->nullable();
            $table->string('total_qty')->nullable();
            $table->string('plank')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('factory')->nullable();
            $table->string('user_id');
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
        Schema::dropIfExists('area_preparation');
    }
}
