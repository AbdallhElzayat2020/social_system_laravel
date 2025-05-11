<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'username' => ['required', 'unique:' . User::class, 'string', 'max:50'],
            'phone' => ['nullable', 'string', 'max:20', 'unique:users,username'],
            'country' => ['nullable', 'string', 'max:50'],
            'city' => ['nullable', 'string', 'max:50'],
            'street' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:2048', 'mimes:`jpeg,png,jpg,gif,svg'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'street' => $request->street,
        ]);

        /* handle imag for user */
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $filename = Str::slug($user->username) . time() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('uploads/users', $filename, ['disk' => 'uploads']);

            $user->update([
                'image' => $path,
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        Session::flash('success', 'Registration successful!');

        return redirect(route('frontend.dashboard.profile', absolute: false));

    }
}
