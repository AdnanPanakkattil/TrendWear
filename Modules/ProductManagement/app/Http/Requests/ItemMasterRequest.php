<?php

namespace Modules\ProductManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ItemMasterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'sku' => 'nullable|string|max:100',
            'itemcodeId' => 'nullable|string|max:100',
            'item_code' => 'nullable|string|max:100',
            'item_ref_code' => 'nullable|string|max:100',
            'itemName_en' => 'required_without:name_en|nullable|string|max:255',
            'name_en' => 'required_without:itemName_en|nullable|string|max:255',
            'itemName_ar' => 'nullable|string|max:255',
            'name_ar' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'brand' => 'nullable',
            'size' => 'nullable',
            'size.*' => 'nullable',
            'colors' => 'nullable',
            'colors.*' => 'nullable',
            'color' => 'nullable',
            'color.*' => 'nullable',
            'cost_price' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'offer_price' => 'nullable|numeric|min:0',
            'itemMinRetailPrice' => 'nullable|numeric|min:0',
            'min_retail_price' => 'nullable|numeric|min:0',
            'itemProfitLevel' => 'nullable|string|max:50',
            'profit_level' => 'nullable|string|max:50',
            'itemMinimunQty' => 'nullable|integer|min:0',
            'itenMinimunQty' => 'nullable|integer|min:0',
            'min_qty' => 'nullable|integer|min:0',
            'itemReorderQty' => 'nullable|integer|min:0',
            'reorder_qty' => 'nullable|integer|min:0',
            'itemMaximunQty' => 'nullable|integer|min:0',
            'max_qty' => 'nullable|integer|min:0',
            'itemDescription' => 'nullable|string',
            'description_en' => 'nullable|string',
            'itemDescriptionAr' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'itemNote' => 'nullable|string',
            'note' => 'nullable|string',
            'itemTests' => 'nullable|string|max:255',
            'tests' => 'nullable|string|max:255',
            'itemSample' => 'nullable|string|max:255',
            'sample' => 'nullable|string|max:255',
            'itemResults' => 'nullable|string|max:255',
            'results' => 'nullable|string|max:255',
            'offer_product_status' => 'nullable',
            'best_selling_status' => 'nullable',
            'featured_product' => 'nullable',
            'value_from_start_date' => 'nullable|date',
            'offer_start_date' => 'nullable|date',
            'value_from_end_date' => 'nullable|date',
            'offer_end_date' => 'nullable|date',
            'master_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sub_images' => 'nullable|array',
            'sub_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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
            'itemName_en.required_without' => 'Title (English) is required.',
            'name_en.required_without' => 'Title (English) is required.',
            'category_id.exists' => 'Selected Category is invalid.',
            'sub_category_id.exists' => 'Selected Sub Category is invalid.',
            'master_image.image' => 'The master image must be an image file.',
            'master_image.max' => 'The master image may not be greater than 2MB.',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $costPrice = $this->input('cost_price');
            $sellingPrice = $this->input('selling_price');

            if ($costPrice !== null && $costPrice !== '' && is_numeric($costPrice) && (float) $costPrice > 0) {
                if ($sellingPrice === null || $sellingPrice === '' || ! is_numeric($sellingPrice)) {
                    $validator->errors()->add('selling_price', 'Selling price is required and must be greater than or equal to cost price.');
                } elseif ((float) $sellingPrice < (float) $costPrice) {
                    $validator->errors()->add('selling_price', 'Selling price cannot be less than cost price ('.number_format((float) $costPrice, 2).').');
                }
            } elseif ($sellingPrice !== null && $sellingPrice !== '' && is_numeric($sellingPrice) && $costPrice !== null && $costPrice !== '' && is_numeric($costPrice)) {
                if ((float) $sellingPrice < (float) $costPrice) {
                    $validator->errors()->add('selling_price', 'Selling price cannot be less than cost price ('.number_format((float) $costPrice, 2).').');
                }
            }
        });
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
