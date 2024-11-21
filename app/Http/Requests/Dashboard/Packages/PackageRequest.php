<?php

namespace App\Http\Requests\Dashboard\Packages;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar'=>['required','string','max:255'],
            'name_en'=>['required','string','max:255'],
            'price'=>['required','numeric','gte:0'],
            'color'=>['required','hex_color'],
            'special_offers'=>['nullable','numeric','gte:0'],
            'subscription_months'=>['nullable','numeric','gte:0'],
            'can_add_sub_user'=>['required','boolean'],
            'has_verified_badge'=>['required','boolean'],
            'can_view_company_file'=>['required','boolean'],
            'is_fallback'=>['required','boolean'],

        ];
    }
}
