<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        $auth = auth()->guard('admin')->user();
        return view('dashboard.pages.profile.index', compact('auth'));
    }

    public function update(Request $request)
    {
//        return $request;
        $request->validate($this->validateData());
        $id = auth()->guard('admin')->user()->id;
        $admin = Admin::findOrFail($id);

        if (!Hash::check($request->password, $admin->password)) {
            Session::flash('error', 'Current password is incorrect');
            return redirect()->back();
        }

        $admin->update($request->except(['password', '_token']));
        Session::flash('success', 'Profile updated successfully');
        return redirect()->back();
    }


    private function validateData(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:200'],
            'email' => ['required', 'email', 'max:200', 'unique:admins,email,' . auth()->guard('admin')->user()->id],
            'password' => ['required', 'string']
        ];
    }
}
