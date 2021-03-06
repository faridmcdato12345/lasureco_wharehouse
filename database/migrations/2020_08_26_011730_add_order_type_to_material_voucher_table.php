<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderTypeToMaterialVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('material_voucher', function (Blueprint $table) {
            $table->unsignedBigInteger('order_type');
            $table->string('order_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('material_voucher', function (Blueprint $table) {
            $table->dropColumn('order_type');
            $table->dropColumn('order_number');
        });
    }
}
