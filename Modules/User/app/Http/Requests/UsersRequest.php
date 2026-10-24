<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name_en' => 'required',
            'name_ar' => 'nullable',
            'username' => 'required|string|max:100|unique:users,username',
            'email' => 'required|email|max:191|unique:users,email',
            'password' => 'required|min:8',
            'mobile_no' => 'nullable',
            'joined_date' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name_en.required'     => 'English name is required.',
            'name_ar.required'     => 'Arabic name is required.',
            'username.required'    => 'Username is required.',
            'email.required'       => 'Email address is required.',
            'email.email'          => 'Please enter a valid email address.',
            'password.required'    => 'Password is required.',
            'mobile_no.required'   => 'Mobile number is required.',
            'joined_date.required' => 'Joined date is required.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
