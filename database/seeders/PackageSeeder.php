<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::query()->insert([
            [
                'name_ar' => 'الباقة العادية',
                'name_en' => 'Regular Package',
                'color' => '#E6DAED',
                'price' => 0,
                'subscription_months' => null,
                'special_offers' => 0,
                'can_add_sub_user' => false,
                'has_verified_badge' => false,
                'can_view_company_file' => false,
                'is_fallback' => true,
                'is_active' => true
            ],
            [
                'name_ar' => 'الباقة البرونزية',
                'name_en' => 'Bronze Package',
                'color' => '#F8CB90',
                'price' => 599,
                'subscription_months' => 3,
                'special_offers' => 3,
                'can_add_sub_user' => true,
                'has_verified_badge' => true,
                'can_view_company_file' => true,
                'is_fallback' => false,
                'is_active' => true
            ],
            [
                'name_ar' => 'الباقة الفضية',
                'name_en' => 'Sliver Package',
                'color' => '#EBEEFF',
                'price' => 999,
                'subscription_months' => 6,
                'special_offers' => 15,
                'can_add_sub_user' => true,
                'has_verified_badge' => true,
                'can_view_company_file' => true,
                'is_fallback' => false,
                'is_active' => true
            ],
            [
                'name_ar' => 'الباقة الذهبية',
                'name_en' => 'Golden Package',
                'color' => '#FFF7B4',
                'price' => 1599,
                'subscription_months' => 12,
                'special_offers' => null,
                'can_add_sub_user' => true,
                'has_verified_badge' => true,
                'can_view_company_file' => true,
                'is_fallback' => false,
                'is_active' => true
            ],
        ]);
    }
}
