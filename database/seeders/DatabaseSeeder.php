<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Field;
use App\Models\CompanyField;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Country::factory(50)->create();

        // City::factory(200)->create();

        // Field::factory(20)->create();

        // $this->call([
        //     PackageSeeder::class,
        // ]);

        Company::factory(1)->create();

        CompanyField::factory(1)->create();

        User::factory(1)->create();

        // $this->call([
        //     PurchaseOrderDemandUnitTypeSeeder::class,
        //     PurchaseOrderTaxSeeder::class,
        //     LoyaltyPointsSettingSeeder::class,
        //     LaratrustSeeder::class,
        //     ManagerSeeder::class,
        // ]);

    }
}
