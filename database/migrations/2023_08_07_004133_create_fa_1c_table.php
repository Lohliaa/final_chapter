<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFa1cTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fa_1c', function (Blueprint $table) {
            $table->id();
            $table->string('car_line')->nullable();
            $table->string('conveyor')->nullable();
            $table->string('addressing_store')->nullable();
            $table->string('ctrl_no')->nullable();
            $table->string('colour')->nullable();
            $table->string('qty_kbn')->nullable();
            $table->string('issue')->nullable();
            $table->string('total_qty')->nullable();
            $table->string('housing')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('sai')->nullable();
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
        Schema::dropIfExists('fa_1c');
    }
}
