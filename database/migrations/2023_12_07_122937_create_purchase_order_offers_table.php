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
        Schema::create('purchase_order_offers', function (Blueprint $table) {
            $table->id();
            $table->string('reference_id')->nullable()->unique();
            $table->foreignId('purchase_order_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('purchase_order_tax_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->string('attachment')->nullable();
            $table->boolean('is_special')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_offers');
    }
};
