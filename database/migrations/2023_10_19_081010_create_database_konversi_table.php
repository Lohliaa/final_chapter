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
            $table->string('nomor_komponen')->nullable();
            $table->string('item')->nullable();
            $table->string('nama_komponen')->nullable();
            $table->string('satuan')->nullable();
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
