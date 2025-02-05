<?php

namespace App\Http\Requests\Dashboard\PurchaseOrder;

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
            'status'=>['required',Rule::in('under_review','available','canceled','expired','approved')],
            'purchase_order_id'=>['required',Rule::exists('purchase_orders','id')]
        ];
    }
}
