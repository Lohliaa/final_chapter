<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesTable extends Migration
{

    public function up()
    {
        Schema::create('proses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_final_id');
            $table->foreign('area_final_id')->references('id')->on('area_final');
            $table->string('material_properties')->nullable();
            $table->string('model')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('warna')->nullable();
            $table->string('model_ukuran_warna')->nullable();
            $table->string('specific_component_number')->nullable();
            $table->string('cl')->nullable();
            $table->string('trm_b')->nullable();
            $table->string('acc_bag_b1')->nullable();
            $table->string('acc_bag_b2')->nullable();
            $table->string('tbe_b')->nullable();
            $table->string('trm_a')->nullable();
            $table->string('acc_bag_a1')->nullable();
            $table->string('acc_bag_a2')->nullable();
            $table->string('tbe_a')->nullable();
            $table->double('price_sum')->nullable();
            $table->double('wire_cost')->nullable();
            $table->double('component_cost')->nullable();
            $table->double('material_cost')->nullable();
            $table->double('material_cost_amount')->nullable();
            $table->integer('process')->nullable();
            $table->double('umh')->nullable();
            $table->float('charge')->nullable();
            $table->double('process_cost')->nullable();
            $table->double('process_cost_amount')->nullable();
            $table->double('total_amount')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('proses');
    }
}
