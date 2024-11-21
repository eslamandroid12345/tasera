<?php

namespace App\Http\Requests\Api\V1\NewSubscription;

use App\Http\Enums\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewSubscriptionRequest extends FormRequest
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
                    'type' => ['required', 'in:1,2'],
                    'email' => 'required_if:type,2',
                    'phone' => 'nullable',
                    'package_id' => ['required', 'exists:packages,id'],
                ];
    }
}
