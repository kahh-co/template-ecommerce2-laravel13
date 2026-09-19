<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('order_number')->unique();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('address');
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->text('note')->nullable();
            $table->integer('subtotal')->default(0);
            $table->integer('shipping')->default(0);
            $table->integer('total_amount');
            $table->string('payment_status')->default('pending');
            $table->string('order_status')->default('pending');
            $table->string('payment_reference')->nullable();
            $table->string('snap_token')->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->nullOnDelete();
            $table->string('product_name');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('subtotal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
