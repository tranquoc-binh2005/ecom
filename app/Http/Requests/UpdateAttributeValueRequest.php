<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeValueRequest extends FormRequest
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
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'attribute_id.required' => 'Attribute id is required',
            'attribute_id.exists' => 'Attribute id does not exist',
            'value.required' => 'Attribute name is required',
        ];
    }
}
