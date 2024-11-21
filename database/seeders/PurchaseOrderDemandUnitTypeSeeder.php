<?php

namespace Database\Seeders;

use App\Models\PurchaseOrderDemandUnitType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PurchaseOrderDemandUnitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PurchaseOrderDemandUnitType::query()->insert([
            [
                'name_ar' => 'كجم',
                'name_en' => 'Kg',
            ],
            [
                'name_ar' => 'عبوة',
                'name_en' => 'Pack',
            ],
            [
                'name_ar' => 'رطل',
                'name_en' => 'Pound',
            ],
        ]);
    }
}
