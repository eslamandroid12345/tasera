<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use function Symfony\Component\String\b;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('color');
            $table->float('price')->unsigned();
            $table->integer('subscription_months')->nullable()->unsigned()->comment('null => unlimited');
            $table->integer('special_offers')->nullable()->unsigned()->comment('null => unlimited');
            $table->boolean('can_add_sub_user');
            $table->boolean('has_verified_badge');
            $table->boolean('can_view_company_file');
            $table->boolean('is_fallback')->default(false);
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
