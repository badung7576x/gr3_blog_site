<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUpdateArticleRequest extends FormRequest
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
            'slug' => 'required|string|unique:articles,slug,' . $this->id,
            'title' => 'required|string|max:255',
            'session_id' => 'required|string',
            'image' => 'nullable',
            'summary' => 'required|string',
            'content' => 'required|string',
            'publish_time' => 'nullable|date',
            'tags' => 'nullable|string',
            'review_by' => 'nullable|numeric',
            'is_published' => 'required|boolean'
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
            'publish_time' => 'thời gian đăng bài',
            'tags' => 'các thẻ tags',
            'review_by' => 'người đánh giá',
            'is_published' => 'công khai bài viết'
        ];
    }
}
