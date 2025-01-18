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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->string('order_number')->unique();
            $table->foreignId('delivery_id')->nullable();
            $table->foreignId('pickup_id')->nullable();
            $table->string('status')->default('pending')->comment('pending,processing,dispatch,success,cancel,picked-up,return');
            $table->double('total_amount')->default(0.0);
            $table->double('payable_total')->default(0.0);
            $table->double('total_discount')->default(0.0);
            $table->string('receiver_name');
            $table->string('receiver_phone')->nullable();
            $table->string('receiver_email')->nullable();
            $table->text('receiver_address')->nullable();
            $table->double('delivery_charge')->nullable();
            $table->text('order_remarks')->nullable();
            $table->text('customer_note')->nullable();
            $table->string('order_from')->nullable()->comment('pos,app,website');
            
            $table->string('payment_method')->nullable()->comment('SSL,amarpay, stripe','COD');
            $table->string('payment_type')->nullable()->comment('mobile,card');
            // $table->string('delivery_type')->default('ship')->comment('drop/ship,pick-up');
            $table->string('payment_status')->default('pending');
            $table->longText('additional')->nullable();
            $table->string('transaction_id')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
