<?php

namespace App\Http\Enums;

use App\Rules\Phone;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

enum CompanyType: string
{
    use Enumable;

    case SUPPLIER = 'supplier';
    case BUYER = 'buyer';

    public function validationRules()
    {
        $rules = [
            'name' => ['required', 'string'],
            'email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')],
            'password' => ['required', Password::min(8)],
            'user_phone' => ['required', new Phone, Rule::unique('users', 'phone')],
            'name_ar' => ['required', 'string'],
            'name_en' => ['required', 'string'],
            'fields' => ['required', 'array', 'exclude'],
            'fields.*' => [Rule::exists('fields', 'id')->where('is_active', true)],
            'direct_manager_name' => ['required', 'string'],
            'direct_manager_email' => ['required', 'email:rfc,dns', Rule::unique('users', 'direct_manager_email')],
            // 'website_url' => ['nullable', 'url'],
            'website_url' => ['nullable'],
            'logo' => ['required', 'exclude', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
//            'authorization_approval_file' => ['nullable', 'exclude', 'file', 'mimes:pdf,doc,docx', 'max:2048'], // not used right now
            'commercial_registration_no' => ['required'],
            'commercial_registration_image' => ['required', 'exclude', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:2048'],
            'commercial_registration_expiry_date' => ['required', 'date'],
            'is_tax_exempt' => ['required', 'boolean'],
            'tax_registration_no' => [Rule::requiredIf(fn () => !request('is_tax_exempt'))],
            'tax_registration_image' => [Rule::requiredIf(fn () => !request('is_tax_exempt')), 'exclude', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:2048'],
            'city_id' => ['required', Rule::exists('cities', 'id')],
            'company_phone' => ['required', new Phone, Rule::unique('companies', 'phone')],
            'referral_company_reference_id' => ['nullable', Rule::exists('companies', 'reference_id')]
        ];
        return match ($this) {
            self::BUYER => $rules,
            self::SUPPLIER => $rules + [
//                    'bank_details_file' => ['nullable', 'exclude', 'file', 'mimes:pdf,doc,docx', 'max:2048'], // not used right now
                ]
        };
    }

    public function t()
    {
        return match ($this) {
            self::SUPPLIER => __('general.supplier'),
            self::BUYER => __('general.buyer'),
        };
    }
}
