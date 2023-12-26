<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('order_state_id');
            $table->decimal('amount', 8, 2);
            $table->string('description', 255);
            $table->timestamp('date_expiration');
            $table->timestamps();

            // foreign
            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('order_state_id')->references('id')->on('order_states');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
