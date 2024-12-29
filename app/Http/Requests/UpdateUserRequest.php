<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required','email','unique:users,email,' . $this->id,
            'name' => 'required',
            'phone' => 'nullable',
            'address' => 'nullable',
            'gender' => 'not_in:0',
            'birthday' => 'nullable',
            'publish' => 'nullable',
            'image' => 'nullable',
            'role_id' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => __('user_message.required_email'),
            'email.email' => __('user_message.email_email'),
            'email.unique' => __('user_message.email_unique'),
            'name.required' => __('user_message.required_name'),
            'role_id.required' => __('user_message.role_id'),
            'gender.not_in' => __('user_message.required_gender'),
        ];
    }
}
