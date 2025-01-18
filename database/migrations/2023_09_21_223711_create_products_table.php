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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            // $table->integer('brand_id')->nullable();
            // $table->integer('product_collection_id')->nullable();
            // $table->integer('admin_id')->nullable();
            // $table->string('product_name');
            // 
            // $table->string('product_image');
            // $table->text('short_description')->nullable();
            // $table->longText('description');
            // 
            // 
            // $table->text('attributes')->nullable();
            // $table->string('meta_title')->nullable();
            // $table->string('meta_description', 2000)->nullable();
            // $table->string('meta_keywords')->nullable();
            // $table->string('og_image')->nullable();
            // $table->enum('is_popular', ['No', 'Yes']);
            // $table->enum('is_featured', ['No', 'Yes']);
            // $table->enum('is_bestseller', ['No', 'Yes']);
            // $table->enum('is_dealsday', ['No', 'Yes']);
            // $table->tinyInteger('status');
            // $table->string('product_slug')->unique();
            // $table->integer('tax_id')->nullable();
            $table->foreignId('category_id')->constrained('categories')->restrictOnDelete();
            $table->integer('type_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('product_code')->nullable();
            $table->string('product_video')->nullable();
            $table->string('product_tags')->nullable();
            $table->text('short_description');
            $table->longText('long_description')->nullable();
            $table->string('image')->nullable();
            $table->integer('quantity');
            $table->decimal('price')->comment('end user price');
            $table->integer('discount')->nullable();
            $table->string('discount_type')->nullable()->comment('percentage or amount');
            $table->boolean('is_feature')->default(false);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('status')->default('active');
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
        Schema::dropIfExists('products');
    }
};
