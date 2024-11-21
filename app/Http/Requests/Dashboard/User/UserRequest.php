<?php

namespace App\Http\Requests\Dashboard\User;

use App\Rules\Phone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'company_id'=>$this->method=='POST'?['required',Rule::exists('companies','id')]:'nullable',
            'name' => ['required', 'string'],
            'email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')->ignore($this->user)],
            'password' => $this->password ?['required', Password::min(8),'confirmed'] :'nullable',
            'phone' => ['required', new Phone, Rule::unique('users', 'phone')->ignore($this->user)],
            'direct_manager_name' => ['required', 'string'],
            'direct_manager_email' => ['required', 'email:rfc,dns', Rule::unique('users', 'direct_manager_email')->ignore($this->user)],
        ];
    }
}
