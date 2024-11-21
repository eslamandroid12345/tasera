<?php

namespace App\Http\Requests\Api\V1\Company;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CompanyInfoRequest extends FormRequest
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
            'website_url' => ['nullable', 'url'],
            'phone' => ['nullable', new Phone, Rule::unique('companies', 'phone')->ignore(auth('api')->user()->company_id)],
        ];
    }
}
