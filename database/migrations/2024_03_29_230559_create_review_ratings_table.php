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
        Schema::create('review_ratings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->string('status')->default('pending');
            $table->string('approval_status')->default('inactive');
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->foreignId('order_details_id')->constrained('order_details')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
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
        Schema::dropIfExists('review_ratings');
    }
};
