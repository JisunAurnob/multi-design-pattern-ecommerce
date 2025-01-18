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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity');
            $table->double('unit_price', 10, 2);
            $table->double('subtotal', 10, 2);
            $table->double('discount', 10, 2)->nullable();
            $table->double('extra_charge', 10, 2)->nullable();
            $table->text('extra_charge_reason')->nullable();
            $table->double('payable_subtotal', 10, 2)->nullable();
            
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
        Schema::dropIfExists('order_details');
    }
};
