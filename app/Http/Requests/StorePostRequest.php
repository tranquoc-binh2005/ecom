<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'description' => 'nullable',
            'content' => 'nullable',
            'image' => 'nullable',
            'parent_id' => 'required|exists:post_catalogue,id',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
            'slug' => 'required|unique:posts,slug',
            'publish' => 'required|in:1,2',
            'tags' => 'nullable',
            'follow' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('post_message.name_requierd'),
            'parent_id.required' => __('post_message.parent_requierd'),
            'parent_id.exists' => __('post_message.parent_requierd'),
            'slug.required' => __('post_message.slug_requierd'),
            'slug.unique' => __('post_message.slug_unique'),
            'publish.required' => __('post_message.publish_requierd'),
        ];
    }
}
