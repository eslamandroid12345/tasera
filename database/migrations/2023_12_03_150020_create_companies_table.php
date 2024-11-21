<?php

use App\Http\Enums\CompanyType;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('reference_id')->nullable()->unique();
            $table->enum('type', CompanyType::values());
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('website_url');
            $table->string('logo');
            $table->string('authorization_file')->nullable();
            $table->string('authorization_approval_file')->nullable();
            $table->string('commercial_registration_no');
            $table->string('commercial_registration_image');
            $table->date('commercial_registration_expiry_date');
            $table->boolean('is_tax_exempt');
            $table->string('tax_registration_no');
            $table->string('tax_registration_image');
            $table->foreignId('city_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->string('phone')->unique();
            $table->string('bank_details_file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
