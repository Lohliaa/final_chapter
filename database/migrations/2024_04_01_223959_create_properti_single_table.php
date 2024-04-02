<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiSingleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properti_single', function (Blueprint $table) {
            $table->id();
            $table->string('material_properties')->nullable();
            $table->string('model')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('warna')->nullable();
            $table->bigInteger('cl')->nullable();
            $table->string('trm_b')->nullable();
            $table->string('acc_bag_b1')->nullable();
            $table->string('acc_bag_b2')->nullable();
            $table->string('tbe_b')->nullable();
            $table->string('trm_a')->nullable();
            $table->string('acc_bag_a1')->nullable();
            $table->string('acc_bag_a2')->nullable();
            $table->string('tbe_a')->nullable();
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
        Schema::dropIfExists('properti_single');
    }
}
