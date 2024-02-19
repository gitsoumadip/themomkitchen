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
            $table->foreignId('order_details_id')->nullable()->constrained()->references('id')->on('order_details')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('type_id')->nullable()->constrained()->references('id')->on('types')->onDelete('cascade');
            $table->string('qty')->nullable();
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
