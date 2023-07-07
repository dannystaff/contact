<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email_address' => 'email|required',
            'phone_number' => 'numeric|required|digits:11',
            'message' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Please enter your first name',
            'last_name.required' => 'Please enter your last name',
            'email_address.required' => 'Please enter your email address',
            'email_address.email' => 'Please enter a valid email address',
            'phone_number.required' => 'Please enter your phone number',
            'phone_number.size' => 'Please enter a valid 11 digit phone number',
            'message.required' => 'Please enter a message'
        ];
    }
}
