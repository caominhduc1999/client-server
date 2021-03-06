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
            $table->id();
            $table->string('name');
            $table->double('price')->nullable();
            $table->double('sale_price')->nullable();
            $table->bigInteger('inventory_quantity')->nullable();
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->integer('category_id');
            $table->integer('vendor_id');
            $table->integer('is_hot')->default(0);
            $table->integer('is_feature')->default(0);
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
        Schema::dropIfExists('products');
    }
}
