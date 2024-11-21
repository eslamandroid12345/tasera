<?php

namespace App\Http\Requests\Api\V1\Complaint;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;

class ComplaintRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'phone' => ['required', new Phone],
            'email' => ['required', 'email:rfc,dns'],
            'message_title' => ['required'],
            'message_content' => ['required'],
        ];
    }
}
