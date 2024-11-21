<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manager = Manager::query()->firstOrCreate(
            [
                'email' => 'admin@tasera.com',
            ],
            [
                'name' => 'Super Admin',
                'phone' => fake()->phoneNumber(),
                'password' => bcrypt('elryad@1256'),
                'is_active' => true,
            ]
        );

        $manager->addRole('super_admin');
    }
}
