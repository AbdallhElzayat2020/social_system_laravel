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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'min:3', 'max:255', 'unique:users,username'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
            'phone' => ['required', 'unique:users,phone', 'max:18'],
            'status' => ['required', 'in:active,inactive'],
            'email_verified_at' => ['required', 'in:active,inactive'],
            'city' => ['nullable', 'max:255', 'string'],
            'country' => ['nullable', 'max:255', 'string', 'min:2'],
            'street' => ['nullable', 'max:255', 'string', 'min:2'],
            'image' => ['image', 'mimes:jpeg,png,jpg', 'max:3000', 'required'],


        ];
    }
}
