<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialCreditTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material__credit__tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mcrt_number');
            $table->string('mct_number')->nullable();
            $table->string('place_of_const')->nullable();
            $table->string('description_of_work')->nullable();
            $table->string('order_type')->nullable();
            $table->string('order_number')->nullable();
            $table->string('returned_by');
            $table->string('received_by');
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
        Schema::dropIfExists('material__credit__tickets');
    }
}
