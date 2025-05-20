<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use App\Utils\ImageManager;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //

    public function index()
    {
        return view('dashboard.pages.settings.index');
    }

    public function update(SettingRequest $request)
    {
        $setting = Setting::findOrFail($request->setting_id);

        // Initialize with existing values
        $logo_path = $setting->site_logo;
        $favicon_path = $setting->site_favicon;

        if ($request->hasFile('site_logo')) {
            $file = ImageManager::generateImageName($request->site_logo);
            $logo_path = ImageManager::storeImageInLocal($request->site_logo, 'settings', $file);
        }

        if ($request->hasFile('site_favicon')) {
            $file = ImageManager::generateImageName($request->site_favicon);
            $favicon_path = ImageManager::storeImageInLocal($request->site_favicon, 'settings', $file);
        }

        $request->merge([
            'site_logo' => $logo_path,
            'site_favicon' => $favicon_path
        ]);

        $updated = $setting->update($request->except('_token', 'setting_id'));

        if (!$updated) {
            return redirect()->back()->with('error', 'Something went wrong');
        }

        return redirect()->back()->with('success', 'Settings updated successfully');
    }
}
