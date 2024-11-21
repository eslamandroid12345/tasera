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
        Schema::create('purchase_order_demand_unit_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_offer_id');
            $table->unsignedBigInteger('purchase_order_demand_unit_id');
            $table->foreign('purchase_order_offer_id', 'purchase_order_offer_fk')->references('id')->on('purchase_order_offers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('purchase_order_demand_unit_id', 'purchase_order_demand_unit_fk')->references('id')->on('purchase_order_demand_units')->cascadeOnUpdate()->cascadeOnDelete();
            $table->float('price')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_demand_unit_offers');
    }
};
