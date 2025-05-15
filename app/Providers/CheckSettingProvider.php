<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\RelatedNewsSite;
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
        $getSetting = Setting::firstOr(function () {
            return Setting::create([
                'site_name' => 'News App',
                'site_logo' => '/img/logo.png',
                'site_email' => 'news@gmail.com',
                'site_phone' => '+201212484233',
                'site_address' => 'Mahala, Egypt',
                'meta_title' => 'news app',
                'meta_description' => 'news app',
                'site_favicon' => 'default',
                'facebook_link' => 'https://www.facebook.com/',
                'twitter_link' => 'https://twitter.com/',
                'instagram_link' => 'https://www.instagram.com/',
                'linkedin_link' => 'https://www.linkedin.com/',
                'youtube_link' => 'https://www.youtube.com/',
                'street' => 'Elsharawy',
                'city' => 'Elmansoura',
                'country' => 'Egypt',
            ]);
        });


        // Share the setting with all views
        view()->share([
            'getSetting' => $getSetting,
        ]);
    }
}
