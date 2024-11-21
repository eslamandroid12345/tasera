<?php

namespace App\Http\Requests\Api\V1\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyMetadataRequest extends FormRequest
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
            'about_us' => ['nullable', 'string'],
            'vision' => ['nullable', 'string'],
            'message' => ['nullable', 'string'],
            'achievements_file' => ['nullable', 'exclude', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
        ];
    }
}
