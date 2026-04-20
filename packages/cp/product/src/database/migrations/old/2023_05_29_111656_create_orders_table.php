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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('post_code')->nullable();
            $table->string('city')->nullable();
            $table->text('note')->nullable();
            $table->decimal('product_price', 8, 2)->nullable();
            $table->decimal('delivery_cost', 8, 2)->default(0);
            $table->decimal('total_amount', 8, 2)->nullable();
            $table->decimal('paid_amount', 8, 2)->nullable();
            $table->string('order_status')->default('pending');
            $table->string('payment_status')->default('unpaid');
            $table->timestamp('pending_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('ready_to_ship_at')->nullable();
            $table->timestamp('shiped_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->unsignedBigInteger('addedby_id')->nullable();
            $table->unsignedBigInteger('editedby_id')->nullable();
            $table->timestamps();
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
