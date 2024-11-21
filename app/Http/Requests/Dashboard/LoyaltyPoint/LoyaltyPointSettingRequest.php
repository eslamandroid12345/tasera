<?php

namespace App\Http\Requests\Dashboard\LoyaltyPoint;

use Illuminate\Foundation\Http\FormRequest;

class LoyaltyPointSettingRequest extends FormRequest
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
            'points'=>['required','gt:0','numeric']
        ];
    }
}
