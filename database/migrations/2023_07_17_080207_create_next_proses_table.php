<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNextProsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('next_proses', function (Blueprint $table) {
            $table->id();
            $table->string('carline')->nullable();
            $table->string('type')->nullable();
            $table->string('jenis')->nullable();
            $table->string('ctrl_no')->nullable();
            $table->string('jenis_ctrl_no')->nullable();
            $table->string('ctrl_no_cct')->nullable();
            $table->string('kind')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('kind_size_color')->nullable();
            $table->string('cust_part_no')->nullable();
            $table->bigInteger('cl')->nullable();
            $table->string('term_b')->nullable();
            $table->string('accb1')->nullable();
            $table->string('accb2')->nullable();
            $table->string('tubeb')->nullable();
            $table->string('term_a')->nullable();
            $table->string('acca1')->nullable();
            $table->string('acca2')->nullable();
            $table->string('tubea')->nullable();
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
        Schema::dropIfExists('next_proses');
    }
}
