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
        Schema::create('delivery_prices', function (Blueprint $table) {
            $table->id();
            $table->string('gst_restaurant');
            $table->string('delivery_patner_km');
            $table->string('delivery_patner_fee');
            $table->string('packing_charge');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_prices');
    }
};


// "gst_restaurant" => "5"
// "delivery_patner_km" => "5"
// "delivery_patner_fee" => "55"
// "packing_charge" => "5"
// ]