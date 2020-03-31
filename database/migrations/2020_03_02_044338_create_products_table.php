<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description');
            $table->string('img_path');
            $table->decimal('cost', 10, 2);
            $table->date('acquired_at');
            $table->string('condition');
            $table->string('serial_no');
            $table->boolean('isAvailable')->default(true);
            $table->integer('quantity');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('manufacturer_id');
            $table->timestamps();

            //link the products table to the categories table via its foreign key
            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onDelete('restrict')
            ->onUpdate('cascade');

            //link the products table to the suppliers table via its foreign key
            $table->foreign('supplier_id')
            ->references('id')
            ->on('suppliers')
            ->onDelete('restrict')
            ->onUpdate('cascade');

        //link the products table to the suppliers table via its foreign key
            $table->foreign('manufacturer_id')
            ->references('id')
            ->on('manufacturers')
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
        Schema::dropIfExists('products');
    }
}
