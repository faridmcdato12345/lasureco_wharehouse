<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlanketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blankets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('material_id');
            $table->bigInteger('request_voucher_no');
            $table->string('place_of_const');
            $table->timestamps();
            $table->foreign('id')->references('id')->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blankets');
    }
}
