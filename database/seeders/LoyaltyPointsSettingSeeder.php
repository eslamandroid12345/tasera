<?php

namespace Database\Seeders;

use App\Models\LoyaltyPointsSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoyaltyPointsSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoyaltyPointsSetting::query()->insert([
            [
                'name' => \App\Http\Enums\LoyaltyPointsSetting::REGISTER->value,
                'points' => 5
            ],
            [
                'name' => \App\Http\Enums\LoyaltyPointsSetting::PURCHASE_ORDER_APPROVAL->value,
                'points' => 10
            ],
        ]);
    }
}
