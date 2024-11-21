<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Field;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyField>
 */
class CompanyFieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fieldId = Field::query()->inRandomOrder()->first()->id;
        $companyId = Company::query()->inRandomOrder()->first()->id;

        return [
            'field_id' => $fieldId,
            'company_id' => $companyId,
        ];
    }
}
