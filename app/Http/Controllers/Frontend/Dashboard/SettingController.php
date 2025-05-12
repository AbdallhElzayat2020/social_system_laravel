<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\SettingRequest;
use App\Models\User;
use App\Utils\ImageManager;

class SettingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('frontend.dashboard.setting', compact('user'));
    }

    public function update(SettingRequest $request)
    {
        $request->validated();

        $user = User::findOrFail(auth()->id());

        $user->update($request->except('image'));

        ImageManager::uploadImages($request, null, $user);

        return redirect()->back()->with('success', 'Your profile has been updated successfully');
    }
}
