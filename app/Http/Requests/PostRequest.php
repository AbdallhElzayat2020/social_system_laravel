<?php

namespace App\Http\Requests;

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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:100'],
            'description' => ['required', 'string', 'min:3'],
            'category_id' => ['required', 'exists:categories,id'],
            'comment_able' => ['nullable', 'in:on,off,0,1'],
            'meta_description' => ['nullable', 'string', 'max:160'],
            'meta_title' => ['nullable', 'string', 'max:100'],
            'images' => ['sometimes', 'required'],
            'status' => ['nullable', 'in:active,inactive'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

}
