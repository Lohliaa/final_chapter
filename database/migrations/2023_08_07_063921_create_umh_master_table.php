<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmhMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umh_master', function (Blueprint $table) {
            $table->id();
            $table->string('kav')->nullable();
            $table->double('code_umh1')->nullable();
            $table->double('code_umh2')->nullable();
            $table->double('code_umh3')->nullable();
            $table->double('kode_umh1')->nullable();
            $table->double('kode_umh2')->nullable();
            $table->double('kode_umh3')->nullable();
            $table->float('charge')->nullable();
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
        Schema::dropIfExists('umh_master');
    }
}
