<?php

namespace App\Http\Requests\Dashboard\Structure;

use Illuminate\Foundation\Http\FormRequest;

class InfoRequest extends FormRequest
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
            'en.title'=>'required|max:255',
            'en.desc'=>'required',
            'ar.title'=>'required|max:255',
            'ar.desc'=>'required',
            'all.contacts.complaints_phones.*'=>'required|numeric',
            'all.contacts.contact_us_phone'=>'required|numeric',
            'all.social.*.link'=>'required|url',
            'file.*'=>'image',
            'file.123'=>['nullable','mimes:pdf,doc,docx','exclude','file']
        ];
    }
}
