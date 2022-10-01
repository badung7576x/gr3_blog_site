<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name' => 'required|string',
            'session_name' => 'required|array',
            'session_name.*' => 'required|string',
            'session_start' => 'required|array',
            'session_start.*' => 'required|date',
            'session_end' => 'required|array',
            'session_end.*' => 'required|date',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'danh mục',
            'session_name.*' => 'tên phiên',
            'session_start.*' => 'bắt đầu',
            'session_end.*' => 'kết thúc',
        ];
    }
}
