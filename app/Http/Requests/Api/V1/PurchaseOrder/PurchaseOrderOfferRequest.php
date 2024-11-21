<?php

namespace App\Http\Requests\Api\V1\PurchaseOrder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PurchaseOrderOfferRequest extends FormRequest
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
            'purchase_order_tax_id' => ['required', Rule::exists('purchase_order_taxes', 'id')],
            'attachment' => ['nullable', 'exclude', 'file', 'mimes:pdf,doc,docx,xlsx,xlsm,xlsb,xltx,xltm,xlsm,xls,png,gif,jpg,jpeg', 'max:2048'],
            'is_special' => ['required', 'boolean'],
            'demand_units' => ['required', 'array'],
            'demand_units.*.purchase_order_demand_unit_id' => ['required', Rule::exists('purchase_order_demand_units', 'id')],
            'demand_units.*.price' => ['required', 'numeric'],
        ];
    }
}
