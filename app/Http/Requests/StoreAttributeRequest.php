<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttributeRequest extends FormRequest
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
            'name' => 'required|unique:attributes,name',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Attribute name is required',
            'name.string' => 'Attribute name must be string',
            'name.unique' => 'Attribute name must be unique',
        ];
    }
}
