<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\SettingRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $user = User::findOrFail(auth()->user()->id);
        $user->update([
            $request->except(['image'])
        ]);
        return redirect()->back()->with('success', 'Your profile has been updated successfully');
    }
}
