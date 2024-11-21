<?php

namespace App\Http\Requests\Dashboard\Company;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CompanyRequest extends FormRequest
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
            'name_ar' => ['required', 'string'],
            'name_en' => ['required', 'string'],
            'about_us' => ['nullable', 'string'],
            'vision' => ['nullable', 'string'],
            'message' => ['nullable', 'string'],
            'type'=>['required','in:supplier,buyer'],
            'fields' => ['required', 'array', 'exclude'],
            'fields.*' => [Rule::exists('fields', 'id')->where('is_active', true)],
            'website_url' => ['nullable', 'url'],
            'logo' => $this->logo ? ['required', 'exclude', 'image', 'mimes:jpg,jpeg,png', 'max:2048'] :'nullable',
            'authorization_approval_file' =>$this->authorization_approval_file? ['nullable', 'exclude', 'file', 'mimes:pdf,doc,docx', 'max:2048']:'nullable',
            'commercial_registration_no' => ['required'],
            'commercial_registration_image' => $this->commercial_registration_image? ['required', 'exclude', 'file', 'mimes:pdf,doc,docx', 'max:2048']:'nullable',
            'commercial_registration_expiry_date' => ['required', 'date'],
            'is_tax_exempt' => ['required', 'boolean'],
            'tax_registration_no' => ['required'],
            'tax_registration_image' =>$this->tax_registration_image ? ['required', 'exclude', 'file', 'mimes:pdf,doc,docx', 'max:2048']:'nullable',
            'city_id' => ['required', Rule::exists('cities', 'id')],
            'phone' => ['required', new Phone,$this->method== "POST"? Rule::unique('companies', 'phone'):Rule::unique('companies', 'phone')->ignore($this->company)],
            'bank_details_file' =>$this->bank_details_file ? ['nullable', 'exclude', 'file', 'mimes:pdf,doc,docx', 'max:2048']:'nullable',
            'achievements_file' =>$this->achievements_file ? ['nullable', 'exclude', 'file', 'mimes:pdf,doc,docx', 'max:2048']:'nullable',
        ];
    }
}
