<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('product'); // null khi store, có ID khi update

        return [
            'productname' => [
                'required',
                'min:5',
                'max:200',
                Rule::unique('products', 'productname')->ignore($id, 'id'),
            ],
            'slug' => [
                'required',
                'min:5',
                'max:250',
                'regex:/^[a-z0-9_-]+$/',
                Rule::unique('products', 'slug')->ignore($id, 'id'),
            ],
            'cateid' => [
                'required',
                Rule::exists('categories', 'cateid'),
            ],
            'brand_id' => [
                'required',
                Rule::exists('brands', 'id'),
            ],
            'price' => 'required|numeric|min:0|max:10000000',
            'price_sale' => 'nullable|numeric|min:0|lte:price',
            'status' => 'nullable|in:0,1',
            'description' => 'nullable|regex:/^[^@!$^]*$/',
        ];
    }

    public function messages(): array
    {
        return [
            'productname.required'  => ':attribute không được để trống.',
            'productname.min'       => ':attribute phải có ít nhất :min ký tự.',
            'productname.max'       => ':attribute không vượt quá :max ký tự.',
            'productname.unique'    => ':attribute này đã tồn tại.',

            'slug.required'         => ':attribute không được để trống.',
            'slug.min'               => ':attribute phải có ít nhất :min ký tự.',
            'slug.max'               => ':attribute không vượt quá :max ký tự.',
            'slug.unique'            => ':attribute này đã tồn tại.',
            'slug.regex'             => ':attribute chỉ được chứa chữ thường, số, dấu gạch ngang (-) và gạch dưới (_).',

            'cateid.required'       => 'Vui lòng chọn :attribute.',
            'cateid.exists'         => ':attribute không tồn tại.',

            'brand_id.required'     => 'Vui lòng chọn :attribute.',
            'brand_id.exists'       => ':attribute không tồn tại.',

            'price.required'        => ':attribute không được để trống.',
            'price.numeric'         => ':attribute phải là số.',
            'price.min'             => ':attribute không được nhỏ hơn :min.',
            'price.max'             => ':attribute không được lớn hơn :max.',

            'price_sale.numeric'    => ':attribute phải là số.',
            'price_sale.min'        => ':attribute không được nhỏ hơn :min.',
            'price_sale.lte'        => ':attribute không được lớn hơn giá gốc.',

            'status.in'             => ':attribute không hợp lệ.',

            'description.regex'     => ':attribute không được chứa các ký tự đặc biệt như @, !, $, ^.',
        ];
    }

    public function attributes(): array
    {
        return [
            'productname' => 'Tên sản phẩm',
            'slug'        => 'Đường dẫn (Slug)',
            'cateid'      => 'Loại sản phẩm',
            'brand_id'    => 'Thương hiệu',
            'price'       => 'Giá',
            'price_sale'  => 'Giá khuyến mãi',
            'status'      => 'Trạng thái',
            'description' => 'Mô tả sản phẩm',
        ];
    }
}