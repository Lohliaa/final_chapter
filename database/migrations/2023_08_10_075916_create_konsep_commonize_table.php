<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsepCommonizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konsep_commonize', function (Blueprint $table) {
            $table->id();
            $table->string('ctrl_no')->nullable();
            $table->string('kind_new')->nullable();
            $table->string('size_new')->nullable();
            $table->string('col_new')->nullable();
            $table->bigInteger('cl_28')->nullable();
            $table->string('term_b_new')->nullable();
            $table->string('acc_b1_new')->nullable();
            $table->string('acc_b2')->nullable();
            $table->string('tube_b_new')->nullable();
            $table->string('term_a_new')->nullable();
            $table->string('acc_a1_new')->nullable();
            $table->string('acc_a2')->nullable();
            $table->string('tube_a_new')->nullable();
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
        Schema::dropIfExists('konsep_commonize');
    }
}
