<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\SettingRequest;
use App\Models\User;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function changePassword(Request $request)
    {
        //filter password from request
        $request->validate($this->filterPasswordRequest());

        if (Hash::check($request->current_password, auth()->user()->password)) {
            $user = User::findOrFail(auth()->id());
            $user->update(['password' => Hash::make($request->password)]);
            return redirect()->back()->with('success', 'Your password has been changed successfully');
        } else {
            return redirect()->back()->with('error', 'Current password is incorrect');
        }
    }

    private function filterPasswordRequest(): array
    {
        return [
            'current_password' => ['required', 'string', 'min:8', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:8'],
        ];
    }
}
