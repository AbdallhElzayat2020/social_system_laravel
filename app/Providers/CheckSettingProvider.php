<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class CheckSettingProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Setting::firstOr(function () {
            return Setting::create([
                'site_name' => 'News App',
                'site_logo' => 'default',
                'site_email' => 'news@gmail.com',
                'site_phone' => '+201212484233',
                'site_address' => 'Egypt',
                'meta_title' => 'Default',
                'meta_description' => 'Default',
                'site_favicon' => 'default',
                'facebook_link' => 'https://www.facebook.com/',
                'twitter_link' => 'https://twitter.com/',
                'instagram_link' => 'https://www.instagram.com/',
                'linkedin_link' => 'https://www.linkedin.com/',
                'youtube_link' => 'https://www.youtube.com/',
                'tiktok_link' => 'https://www.tiktok.com/',
                'street' => 'Default Street',
                'city' => 'Default City',
                'country' => 'Default Country',
            ]);
        });
    }
}
