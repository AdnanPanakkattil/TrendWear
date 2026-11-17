<?php

namespace Modules\ProductManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'code' => 'required|string|max:50',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'nullable',
            'chest_inch' => 'nullable|numeric|min:0',
            'waist_inch' => 'nullable|numeric|min:0',
            'shoulder_inch' => 'nullable|numeric|min:0',
            'length_inch' => 'nullable|numeric|min:0',
            'sleeve_length_inch' => 'nullable|numeric|min:0',
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
            'name.required' => 'Size name is required.',
            'code.required' => 'Size code is required.',
            'category_id.exists' => 'The selected category is invalid.',
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
