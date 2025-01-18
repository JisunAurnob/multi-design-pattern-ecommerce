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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('password');
            $table->string('status')->default('active');
            $table->text('remarks')->nullable();
            $table->text('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('image')->nullable();
            $table->string('otp')->nullable();
            $table->string('token')->nullable();
            $table->text('device_token')->nullable();
            $table->dateTime('otp_expire_at')->nullable();
            $table->boolean('is_email_verified')->default(false);
            $table->boolean('is_mobile_verified')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('customers');
    }
};
