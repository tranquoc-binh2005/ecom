<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'slug' => 'required|unique:products,slug',
            'product_catalogue_id' => 'required',
            'code' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => __('Bạn chưa nhập tên sản phẩm'),
            'slug.required' => __('Bạn chưa nhập đường dẫn cho sản phẩm này'),
            'slug.unique' => __('Đường dẫn này đã tồn tại. Vui lòng thử đường dẫn khác!'),
            'product_catalogue_id.required' => __('Bạn chưa chọn danh mục cho sản phẩm'),
            'code.required' => __('Bạn chưa nhập mã sản phẩm'),
            'brand_id.required' => __('Bạn chưa chon thương hiệu của sản phẩm'),
            'price.required' => __('Bạn chưa nhập giá cho sản phẩm'),
        ];
    }
}
