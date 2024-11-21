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
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('display_name');
            $table->after('name',function (Blueprint $table){
                $table->string('display_name_en')->nullable();
                $table->string('display_name_ar')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('display_name')->after('name')->nullable();
            $table->dropColumn('display_name_en');
            $table->dropColumn('display_name_ar');
        });
    }
};
