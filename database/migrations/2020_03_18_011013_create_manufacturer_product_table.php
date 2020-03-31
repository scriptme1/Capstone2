<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManufacturerProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manufacturer_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('manufacturer_id');
            $table->unsignedBigInteger('product_id');
            $table->timestamps();

            $table->foreign('manufacturer_id')
            ->references('id')
            ->on('manufacturers')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('restrict')
            ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manufacturer_product');
    }
}
