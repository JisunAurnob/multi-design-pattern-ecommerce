<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id()->constrained('products_images')->onDelete('cascade');
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('attribute_name');
            $table->string('attribute_value');
            $table->double('attribute_price');
            $table->double('product_discount')->nullable();
            $table->bigInteger('stock');
            $table->string('product_sku');
            $table->double('attribute_final_price');
            $table->string('default_attribute');
            $table->string('status');
            $table->string('attribute_alter_text')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->boolean('is_enable_point')->default(false);
            $table->integer('min_order_quantity')->nullable();
            $table->integer('max_order_quantity')->nullable();
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
        Schema::dropIfExists('product_attributes');
    }
};
