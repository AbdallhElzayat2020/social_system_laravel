<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'username' => ['required', 'string', 'min:3', 'unique:users,username,' . $this->user()->id],
            'email' => ['required', 'email', 'max:100', 'unique:users,email,' . $this->user()->id],
            'phone' => ['required', 'string', 'min:5', 'max:30', 'unique:users,phone,' . $this->user()->id],

            'country' => ['nullable', 'string', 'min:2', 'max:50'],
            'city' => ['nullable', 'string', 'min:2', 'max:50'],
            'street' => ['nullable', 'string', 'min:2', 'max:50'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }
}
