<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $countryId = Country::query()->inRandomOrder()->first()->id;

        return [
            'country_id' => $countryId,
            'name_ar' => fake()->city,
            'name_en' => fake()->city,
        ];
    }
}
