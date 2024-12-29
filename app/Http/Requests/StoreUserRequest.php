<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required','email','unique:users,email',
            'password' => 'required|min:6',
            're_password' => 'required|same:password',
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
            'password.required' => __('user_message.required_password'),
            're_password.required' => __('user_message.re_password'),
            're_password.same' => __('user_message.password_same'),
            'name.required' => __('user_message.required_name'),
            'password.min' => __('user_message.password_min'),
            'role_id.required' => __('user_message.role_id'),
            'gender.not_in' => __('user_message.required_gender'),
        ];
    }
}
