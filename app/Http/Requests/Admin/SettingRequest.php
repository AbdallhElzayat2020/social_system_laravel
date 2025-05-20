<?php

namespace App\Http\Requests\Admin;

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
            'site_name' => ['required', 'string', 'max:255', 'min:3'],
            'site_email' => ['required', 'email', 'max:255'],
            'site_phone' => ['required', 'string', 'max:255'],
            'site_address' => ['required', 'string', 'max:255'],
            'meta_title' => ['required', 'string', 'max:255'],
            'meta_description' => ['required', 'string', 'max:255', 'min:3'],
            'site_logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:3000'],
            'site_favicon' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:3000'],
            'facebook_link' => ['nullable', 'url', 'max:255'],
            'twitter_link' => ['nullable', 'url', 'max:255'],
            'instagram_link' => ['nullable', 'url', 'max:255'],
            'linkedin_link' => ['nullable', 'url', 'max:255'],
            'youtube_link' => ['nullable', 'url', 'max:255'],
            'tiktok_link' => ['nullable', 'url', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'setting_id.required' => 'Setting ID is required',
            'setting_id.exists' => 'Invalid setting ID',
            'site_name.required' => 'Site name is required',
            'site_name.min' => 'Site name must be at least 3 characters',
            'site_name.max' => 'Site name cannot exceed 255 characters',
            'site_email.required' => 'Site email is required',
            'site_email.email' => 'Please enter a valid email address',
            'site_phone.required' => 'Site phone is required',
            'site_address.required' => 'Site address is required',
            'meta_title.required' => 'Meta title is required',
            'meta_description.required' => 'Meta description is required',
            'meta_description.min' => 'Meta description must be at least 3 characters',
            'site_logo.image' => 'The logo must be an image file',
            'site_logo.mimes' => 'The logo must be a file of type: jpeg, png, jpg',
            'site_logo.max' => 'The logo may not be greater than 3MB',
            'site_favicon.image' => 'The favicon must be an image file',
            'site_favicon.mimes' => 'The favicon must be a file of type: jpeg, png, jpg',
            'site_favicon.max' => 'The favicon may not be greater than 3MB',
            'facebook_link.url' => 'Please enter a valid Facebook URL',
            'twitter_link.url' => 'Please enter a valid Twitter URL',
            'instagram_link.url' => 'Please enter a valid Instagram URL',
            'linkedin_link.url' => 'Please enter a valid LinkedIn URL',
            'youtube_link.url' => 'Please enter a valid YouTube URL',
            'tiktok_link.url' => 'Please enter a valid TikTok URL',
            'street.required' => 'Street is required',
            'city.required' => 'City is required',
            'country.required' => 'Country is required',
        ];
    }
}
