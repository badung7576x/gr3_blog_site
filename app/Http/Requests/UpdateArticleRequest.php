<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'slug' => 'required|string|unique:articles,slug,' . $this->id,
            'title' => 'required|string|max:255',
            'session_id' => 'required|string',
            'image' => 'nullable',
            'summary' => 'required|string',
            'content' => 'required|string',
            'pdf' => 'nullable|mimes:pdf|max:4000',
            'remove_pdf' => 'nullable',
            'publish_schedule' => 'required|date',
            'tags' => 'nullable|string'
        ];
    }

    public function attributes()
    {
        return [
            'slug' => 'đường dẫn bài viết',
            'title' => 'tiêu đề bài viết',
            'session_id' => 'phiên đăng bài',
            'image' => 'hình ảnh thumbnail',
            'summary' => 'nội dung tóm tắt',
            'content' => 'nội dung bài viết',
            'pdf' => 'file đính kèm',
            'publish_schedule' => 'thời gian đăng bài',
            'tags' => 'các thẻ tags'
        ];
    }
}
