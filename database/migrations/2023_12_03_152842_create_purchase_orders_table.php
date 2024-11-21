<?php

use App\Http\Enums\PurchaseOrderStatus;
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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('reference_id')->nullable()->unique();
            $table->foreignId('company_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->enum('status', PurchaseOrderStatus::values());
            $table->enum('type', ['direct_purchase', 'tender']);
            $table->foreignId('delivery_city_id')->constrained('cities')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('title');
            $table->dateTime('closes_at');
            $table->integer('delivery_duration')->unsigned();
            $table->integer('payment_duration')->unsigned();
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
