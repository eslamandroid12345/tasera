<?php

namespace App\Http\Requests\Api\V1\Subscription;

use App\Http\Enums\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionRequest extends FormRequest
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
            'package_id' => ['required', Rule::exists('packages', 'id')->where('is_active', true)->where('is_fallback', false)],
            'method' => ['required', Rule::enum(PaymentMethod::class)],
            ...PaymentMethod::from($this->input('method'))->validationRules()
        ];
    }
}
