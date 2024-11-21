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
        Schema::table('companies', function (Blueprint $table) {
            $table->after('bank_details_file', function (Blueprint $table) {
                $table->text('about_us')->nullable();
                $table->text('vision')->nullable();
                $table->text('message')->nullable();
                $table->string('achievements_file')->nullable();
                $table->boolean('has_loyalty_points')->default(false);
                $table->foreignId('referral_company_id')->nullable()->constrained('companies')->nullOnDelete()->cascadeOnUpdate();
                $table->boolean('is_active')->default(false);
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign(['referral_company_id']);
            $table->dropColumn(['about_us', 'vision', 'message', 'achievements_file', 'has_loyalty_points', 'referral_company_id', 'is_active']);
        });
    }
};
