<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proses', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->string('car_line')->nullable();
            $table->string('conveyor')->nullable();
            $table->string('addressing_store')->nullable();
            $table->string('ctrl_no')->nullable();
            $table->string('ctrlno')->nullable();
            $table->string('kind')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('kind_size_color')->nullable();
            $table->string('cust_part_no')->nullable();
            $table->string('cl')->nullable();
            $table->string('term_b')->nullable();
            $table->string('accb1')->nullable();
            $table->string('accb2')->nullable();
            $table->string('tubeb')->nullable();
            $table->string('term_a')->nullable();
            $table->string('acca1')->nullable();
            $table->string('acca2')->nullable();
            $table->string('tubea')->nullable();
            $table->string('total_qty')->nullable();
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proses');
    }
}
