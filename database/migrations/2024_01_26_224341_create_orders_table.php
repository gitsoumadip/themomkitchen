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
            $table->string('order_no')->unique();
            $table->foreignId('delivery_addresses_id')->nullable()->constrained()->references('id')->on('delivery_addresses')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->references('id')->on('users')->onDelete('cascade');
            $table->string('qty')->nullable();
            $table->integer('gst_restaurant_charge')->nullable();
            $table->integer('delivery_charge')->nullable();
            $table->integer('packing_charge')->nullable();
            $table->integer('total_price')->nullable();
            $table->tinyInteger('is_active')->default(0)->comment('0:pending,1:aprove,2:cancel,3:process,4:shipment,5:complet')->nullable();
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
