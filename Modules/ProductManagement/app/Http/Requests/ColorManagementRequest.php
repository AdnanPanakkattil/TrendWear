<?php

namespace Modules\ProductManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorManagementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name_en' => 'required|string|max:100',
            'name_ar' => 'required|string|max:100',
            'color_code' => ['required', 'string', 'max:50', 'regex:/^#([a-fA-F0-9]{3}|[a-fA-F0-9]{6})$/i'],
            'status' => 'nullable',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name_en.required' => 'Color name in English is required.',
            'name_ar.required' => 'Color name in Arabic is required.',
            'color_code.required' => 'Color code is required.',
            'color_code.regex' => 'Color code must be a valid hex color (e.g. #FF5733).',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
