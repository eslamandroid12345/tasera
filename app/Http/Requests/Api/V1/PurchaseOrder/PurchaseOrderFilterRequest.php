<?php

namespace App\Http\Requests\Api\V1\PurchaseOrder;

use App\Http\Enums\PurchaseOrderStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PurchaseOrderFilterRequest extends FormRequest
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
            'keyword' => ['nullable', 'string'],
            'sort' => ['nullable', Rule::in(['asc', 'desc'])],
            'statuses' => ['nullable', 'array'],
            'statuses.*' => [Rule::in(PurchaseOrderStatus::filterableValues())],
            'fields' => ['nullable', 'array'],
            'fields.*' => [Rule::exists('fields', 'id')->where('is_active', true)],
            'published_from' => ['nullable', 'required_with:published_to', 'date'],
            'published_to' => ['nullable', 'required_with:published_from', 'date'],
        ];
    }
}
