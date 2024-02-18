<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseKonversiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_konversi', function (Blueprint $table) {
            $table->id();
            $table->string('part_no')->nullable();
            $table->string('buppin')->nullable();
            $table->string('part_name')->nullable();
            $table->string('uom')->nullable();
            $table->integer('inner_packing')->nullable();
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
        Schema::dropIfExists('database_konversi');
    }
}
