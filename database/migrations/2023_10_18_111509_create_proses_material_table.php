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
            $table->string('factory')->nullable();
            $table->string('carcode')->nullable();
            $table->string('area')->nullable();
            $table->string('cavity')->nullable();
            $table->string('partnumber')->nullable();
            $table->string('part_name')->nullable();
            $table->integer('qty_total')->nullable();
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
