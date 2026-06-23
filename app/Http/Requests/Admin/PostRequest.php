<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $id = $this->route('post'); // null on store, ID on update

        return [
            'title'   => 'required|min:5|unique:posts,title,' . ($id ?? 'NULL') . ',id',
            'slug'    => 'required|unique:posts,slug,' . ($id ?? 'NULL') . ',id',
            'user_id' => 'required|exists:users,id',
            'content' => 'nullable',
            'image'   => 'nullable|image|max:2048',
            'status'  => 'nullable|in:0,1',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required'   => 'Vui lòng nhập tiêu đề bài viết.',
            'title.min'        => 'Tiêu đề bài viết phải có ít nhất 5 ký tự.',
            'title.unique'     => 'Tiêu đề bài viết này đã tồn tại.',
            'slug.required'    => 'Vui lòng nhập slug.',
            'slug.unique'      => 'Slug này đã tồn tại.',
            'user_id.required' => 'Vui lòng chọn tác giả.',
            'user_id.exists'   => 'Tác giả không hợp lệ.',
            'image.image'      => 'File tải lên phải là hình ảnh.',
            'image.max'        => 'Kích thước ảnh tối đa là 2MB.',
        ];
    }
}
