<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialCreditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material__credits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mcrt_number');
            $table->unsignedBigInteger('material_id');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('material_id')->references('id')->on('materials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material__credits');
    }
}
