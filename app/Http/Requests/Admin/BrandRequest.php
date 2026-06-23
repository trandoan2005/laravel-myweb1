<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $id = $this->route('brand'); // Trả về ID của brand khi cập nhật

        return [
            'brandname' => 'required|min:3|unique:brands,brandname,' . ($id ?? 'NULL') . ',id',
            'slug'      => 'required|unique:brands,slug,' . ($id ?? 'NULL') . ',id',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'brandname.required' => 'Vui lòng nhập tên thương hiệu.',
            'brandname.min'      => 'Tên thương hiệu phải có ít nhất 3 ký tự.',
            'brandname.unique'   => 'Tên thương hiệu này đã tồn tại.',
            'slug.required'      => 'Vui lòng nhập slug.',
            'slug.unique'        => 'Slug này đã tồn tại.',
        ];
    }
}
