<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    //

    public function index()
    {
        return view('dashboard.pages.settings.index');
    }

    public function update(SettingRequest $request)
    {
        try {
            DB::beginTransaction();
            $setting = Setting::findOrFail($request->setting_id);
            $updated = $setting->update($request->except('_token', 'setting_id', 'site_logo', 'site_favicon'));

            // Initialize with existing values
            $logo_path = $setting->site_logo;
            $favicon_path = $setting->site_favicon;

            if ($request->hasFile('site_logo')) {
                $this->updateLogo($request, $logo_path, $setting);
            }

            if ($request->hasFile('site_favicon')) {
                $this->updateFavicon($request, $favicon_path, $setting);
            }
            DB::commit();

            if (!$updated) {
                return redirect()->back()->withErrors('errors', 'Something went wrong');
            }

        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }

        return redirect()->back()->with('success', 'Settings updated successfully');

    }

    private function updateLogo($request, $logo_path, $setting)
    {
        ImageManager::deleteImageFromLocal($logo_path);
        $file = ImageManager::generateImageName($request->site_logo);
        $logo_path = ImageManager::storeImageInLocal($request->site_logo, 'settings', $file);
        $setting->update([
            'site_logo' => $logo_path,
        ]);
    }

    private function updateFavicon($request, $favicon_path, $setting)
    {
        ImageManager::deleteImageFromLocal($favicon_path);

        $file = ImageManager::generateImageName($request->site_favicon);
        $favicon_path = ImageManager::storeImageInLocal($request->site_favicon, 'settings', $file);
        $setting->update([
            'site_favicon' => $favicon_path,
        ]);
    }
}
