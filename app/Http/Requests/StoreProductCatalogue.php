<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductCatalogue extends FormRequest
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
            'name' => 'required',
            'slug' => 'required|unique:product_catalogue,slug',
            'parent_id' => 'nullable',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => __('productCatalogue_message.required_name'),
            'slug.required' => __('productCatalogue_message.required_slug'),
            'slug.unique' => __('productCatalogue_message.unique_slug'),
        ];
    }
}
