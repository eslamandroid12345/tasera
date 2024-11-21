<?php

use App\Http\Enums\PaymentMethod;
use App\Http\Enums\PaymentStatus;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->enum('method', PaymentMethod::values());
            $table->float('amount')->unsigned();
            $table->enum('status', PaymentStatus::values());
            $table->string('transfer_image')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('from_bank')->nullable();
            $table->string('to_bank')->nullable();
            $table->string('transfer_date')->nullable();
            $table->string('transfer_time')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
