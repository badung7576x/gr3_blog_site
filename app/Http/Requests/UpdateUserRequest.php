<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . $this->id,
            'bio' => 'nullable|string',
            'group_id' => 'numeric',
            'password' => 'nullable|min:6',
            'password_confirm' => 'required_without:id|same:password',
            'image' => 'nullable'
        ];
    }

    public function attributes()
    {
        return [
            'fullname' => 'họ và tên',
            'email' => 'email',
            'bio' => 'mô tả người dùng',
            'group_id' => 'nhóm người dùng',
            'password' => 'mật khẩu',
            'password_confirm' => 'mật khẩu (xác nhận)',
            'image' => 'hình ảnh đại diện'
        ];
    }
}
