<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostCatalogueRequest extends FormRequest
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
            'slug' => 'required|unique:post_catalogue,slug',
            'description' => 'nullable',
            'parent_id' => 'nullable',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => __('postCatalogue_message.required_name'),
            'slug.required' => __('postCatalogue_message.required_slug'),
            'slug.unique' => __('postCatalogue_message.unique_slug'),
        ];
    }
}
