<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_voucher', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('voucher_id');
            $table->string('voucher_code')->nullable();
            $table->string('place_of_const')->nullable();
            $table->string('description_of_work')->nullable();
            $table->bigInteger('quantity')->nullable();
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
        Schema::dropIfExists('material_voucher');
    }
}
