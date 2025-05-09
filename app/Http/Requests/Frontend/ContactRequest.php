<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100', 'min:3'],
            'email' => ['required', 'email', 'max:255'],
            'title' => ['required', 'string', 'max:60'],
            'body' => ['required', 'string', 'max:1000', 'min:10'],
            'phone' => ['required', 'string', 'max:20'],
        ];
    }
}
