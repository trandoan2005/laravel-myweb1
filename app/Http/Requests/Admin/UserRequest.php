<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route('user'); // null on store, ID on update

        $rules = [
            'fullname' => 'required|min:5',
            'username' => 'required|min:3|unique:users,username,' . ($id ?? 'NULL') . ',id',
            'email'    => 'required|email|unique:users,email,' . ($id ?? 'NULL') . ',id',
            'phone'    => 'required',
            'gender'   => 'required|in:0,1,2',
            'role'     => 'nullable|in:0,1',
        ];

        if ($id) {
            // Edit mode
            $rules['password'] = 'nullable|min:6';
            $rules['status']   = 'nullable|in:0,1';
        } else {
            // Create mode
            $rules['password'] = 'required|min:6';
        }

        return $rules;
    }

    /**
     * Get the custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'fullname.required' => 'Vui lòng nhập họ tên.',
            'fullname.min'      => 'Họ tên phải có ít nhất 5 ký tự.',
            'username.required' => 'Vui lòng nhập username.',
            'username.min'      => 'Username phải có ít nhất 3 ký tự.',
            'username.unique'   => 'Username này đã được sử dụng.',
            'email.required'    => 'Vui lòng nhập email.',
            'email.email'       => 'Email không đúng định dạng.',
            'email.unique'      => 'Email này đã được sử dụng.',
            'phone.required'    => 'Vui lòng nhập số điện thoại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min'      => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'gender.required'   => 'Vui lòng chọn giới tính.',
            'gender.in'         => 'Giới tính không hợp lệ.',
        ];
    }
}
