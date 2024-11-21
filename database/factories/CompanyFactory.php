<?php

namespace Database\Factories;

use App\Http\Enums\CompanyType;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cityId = City::inRandomOrder()->first()->id;

        $type = $this->faker->randomElement([CompanyType::SUPPLIER->value, CompanyType::BUYER->value]);

        return [
            'type' => $type,
            'name_ar' => $this->faker->company,
            'name_en' => $this->faker->company,
            'website_url' => $this->faker->url,
            'logo' => $this->faker->imageUrl,
            'authorization_approval_file' => $this->faker->imageUrl,
            'commercial_registration_no' => $this->faker->unique()->numberBetween(1000000000, 9999999999),
            'commercial_registration_image' => $this->faker->imageUrl,
            'commercial_registration_expiry_date' => $this->faker->date,
            'is_tax_exempt' => false,
            'tax_registration_no' => random_int(1000000000, 9999999999),
            'tax_registration_image' => $this->faker->imageUrl,
            'city_id' => $cityId,
            'phone' => $this->faker->unique()->phoneNumber(),
            'bank_details_file' => $type == CompanyType::BUYER ? $this->faker->imageUrl() : null,
            // 'is_active' => true
        ];
    }
}
