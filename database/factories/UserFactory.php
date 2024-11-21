<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companies = Company::query()->select('id')->whereDoesntHave('users')->get()->pluck('id')->toArray();

        return [
            'company_id' => $this->faker->randomElement($companies),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '123123123',
            'phone' => $this->faker->unique()->phoneNumber(),
            'direct_manager_name' => $this->faker->name,
            'direct_manager_email' => $this->faker->unique()->safeEmail(),
            'is_active' => true
        ];
    }
}
