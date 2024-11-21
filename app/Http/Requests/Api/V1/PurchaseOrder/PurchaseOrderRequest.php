<?php

namespace App\Http\Requests\Api\V1\PurchaseOrder;

use App\Http\Enums\PurchaseOrderType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PurchaseOrderRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'type' => ['required', Rule::enum(PurchaseOrderType::class)],
            'delivery_city_id' => ['required', Rule::exists('cities', 'id')],
            'closes_at' => ['required', 'date', 'date_format:Y-m-d H:i', 'after:today'],
            'delivery_duration' => ['required', 'integer', 'gte:1'],
            'payment_duration' => ['required', 'integer', 'gte:1'],
            'description' => ['required', 'string'],
            'fields' => ['required', 'array'],
            'fields.*' => [Rule::exists('fields', 'id')->where('is_active', true)],
            'demand_units' => ['required', 'array'],
            'demand_units.*.name' => ['required', 'string'],
            'demand_units.*.details' => ['required', 'string'],
            'demand_units.*.type_id' => ['required', Rule::exists('purchase_order_demand_unit_types', 'id')],
            'demand_units.*.quantity' => ['required', 'numeric', 'gte:1'],
            'demand_units.*.attachment' => ['nullable', 'exclude', 'file', 'mimes:pdf,doc,docx,xlsx,xlsm,xlsb,xltx,xltm,xlsm,xls,png,gif,jpg,jpeg', 'max:2048'],
        ];
    }
}
