<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('category'); // null khi store, có ID khi update

        return [
            'catename' => [
                'required',
                'min:5',
                'max:100',
                Rule::unique('categories', 'catename')->ignore($id, 'cateid'),
            ],
            'slug' => [
                'required',
                'min:5',
                'max:150',
                'regex:/^[a-z0-9-]+$/',
                Rule::unique('categories', 'slug')->ignore($id, 'cateid'),
            ],
            'status' => 'required|in:0,1',
            'img' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:200',
        ];
    }

    public function messages(): array
    {
        return [
            'required'   => ':attribute không được để trống.',
            'min'        => ':attribute phải từ :min ký tự trở lên.',
            'max'        => ':attribute không vượt quá :max ký tự.',
            'unique'     => ':attribute đã tồn tại.',
            'slug.regex' => ':attribute chỉ được chứa chữ thường, số và dấu gạch ngang (-).',
            'status.in'  => ':attribute không hợp lệ.',
            'img.image'  => 'Trường :attribute phải là hình ảnh.',
            'img.mimes'  => 'Hình ảnh phải có định dạng: jpg, jpeg, png, webp.',
            'img.max'    => 'Hình ảnh không được vượt quá :max KB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'catename' => 'Tên loại sản phẩm',
            'slug'     => 'Đường dẫn (Slug)',
            'status'   => 'Trạng thái',
            'img'      => 'Hình ảnh',
        ];
    }
}