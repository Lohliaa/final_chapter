<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses_material', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('material');
            $table->integer('length')->nullable();
            $table->integer('konversi')->nullable();
            $table->double('qty_after_konversi')->nullable();
            $table->integer('cek')->nullable();
            $table->double('price')->nullable();
            $table->double('amount')->nullable();
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
        Schema::dropIfExists('proses_material');
    }
}
