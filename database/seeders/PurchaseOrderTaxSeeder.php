<?php

namespace Database\Seeders;

use App\Models\PurchaseOrderTax;
use Illuminate\Database\Seeder;

class PurchaseOrderTaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PurchaseOrderTax::query()->insert([
            [
                'value' => 0,
            ],
            [
                'value' => 0.14,
            ],
            [
                'value' => 0.205,
            ],
        ]);
    }
}
