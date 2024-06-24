<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('master_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('master_id')->references('id')->on('masters');
            $table->foreign('product_id')->references('id')->on('products');
            $table->date('order_date');
            $table->date('delivery_date');
            $table->decimal('total_cost', 10, 2);
            $table->enum('status', [
                'new',
                'pending',
                'paid',
                'hipped',
                'delivered',
                'cancelled',
                'refunded',
            ])->default('new');

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
