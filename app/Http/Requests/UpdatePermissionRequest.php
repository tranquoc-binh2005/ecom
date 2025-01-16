<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
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
            'name' => 'required|string',
            'slug' => 'required|string|unique:permissions,slug,' .$this->id,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('permissions.required_name'),
            'slug.required' => __('permissions.required_slug'),
            'slug.unique' => __('permissions.unique_slug'),
            'name.string' => __('permissions.string'),
            'slug.string' => __('permissions.string'),
        ];
    }
}
