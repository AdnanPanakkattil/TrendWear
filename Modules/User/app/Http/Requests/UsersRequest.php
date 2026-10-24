<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UsersRequest extends FormRequest
{
    public function rules(): array
    {
        $userId = $this->route('id') ?? $this->route('user') ?? $this->input('id');
        $isUpdate = !empty($userId);

        return [
            'name_en' => 'required|string|max:100',
            'name_ar' => 'nullable|string|max:100',
            'username' => [
                'required',
                'string',
                'max:100',
                Rule::unique('users', 'username')->ignore($userId)->where(fn ($query) => $query->where('is_delete', 0)),
            ],
            'email' => [
                'required',
                'email',
                'max:191',
                Rule::unique('users', 'email')->ignore($userId)->where(fn ($query) => $query->where('is_delete', 0)),
            ],
            'password' => $isUpdate ? 'nullable|min:8' : 'required|min:8',
            'mobile_no' => 'nullable|string|max:20',
            'joined_date' => 'nullable|date',
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
