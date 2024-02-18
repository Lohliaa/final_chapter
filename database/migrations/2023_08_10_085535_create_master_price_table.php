<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_price', function (Blueprint $table) {
            $table->id();
            $table->string('part_number_ori_sto')->nullable();
            $table->string('part_number_mpl')->nullable();
            $table->string('buppin')->nullable();
            $table->double('price_per_pcs')->nullable();
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
        Schema::dropIfExists('master_price');
    }
}
