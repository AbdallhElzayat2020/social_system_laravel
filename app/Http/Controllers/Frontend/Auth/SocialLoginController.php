<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{


    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $provider_user = Socialite::driver($provider)->user();

            $user = User::where('provider', $provider)
                ->where('provider_id', $provider_user->getId())
                ->first();

            $username = $this->generateUsernameUnique($provider_user->getName());

            if (!$user) {
                $user = User::where('email', $provider_user->getEmail())->first();

                if ($user) {
                    $user->update([
                        'provider' => $provider,
                        'provider_id' => $provider_user->getId(),
                        'provider_token' => $provider_user->token,
                    ]);

                    Auth::login($user);

                    if (is_null($user->email_verified_at)) {
                        return redirect()->route('verification.notice')->with([
                            'success' => 'Welcome back! Please verify your email address.',
                        ]);
                    }

                    return redirect()->route('frontend.dashboard.profile')->with([
                        'success' => 'Welcome back!',
                    ]);
                } else {
                    $user = User::create([
                        'name' => $provider_user->getName(),
                        'email' => $provider_user->getEmail(),
                        'username' => $username,
                        'image' => $provider_user->getAvatar(),
                        'password' => Hash::make(Str::random(10)),
                        'provider' => $provider,
                        'provider_id' => $provider_user->getId(),
                        'provider_token' => $provider_user->token,
                    ]);

                    $user->sendEmailVerificationNotification();

                    Auth::login($user);

                    return redirect()->route('frontend.dashboard.profile')->with([
                        'success' => 'Account created successfully, please verify your email address.',
                    ]);
                }
            }

            Auth::login($user);

            if (is_null($user->email_verified_at)) {
                return redirect()->route('verification.notice')->with([
                    'success' => 'Please verify your email address.',
                ]);
            }

            return redirect()->route('frontend.dashboard.profile')->with([
                'success' => 'Welcome back!',
            ]);

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }


    private function generateUsernameUnique($name)
    {
        $username = Str::slug($name);
        $count = 1;
        while (User::where('username', $username)->exists()) {
            $username = Str::slug($name) . '-' . $count;
            $count++;
        }
    }




    /** ====================== for Api ======================  **/

//    public function callback(Request $request, $provider)
//    {
//        try {
//            if (!$request->has('access_token')) {
//                return response()->json(['error' => 'Access token is required.'], 422);
//            }
//
//            $socialUser = Socialite::driver($provider)->stateless()->userFromToken($request->access_token);
//
//            if (!$socialUser->getEmail()) {
//                return response()->json(['error' => 'No email address returned from provider.'], 400);
//            }
//
//            $user = User::where('provider', $provider)
//                ->where('provider_id', $socialUser->getId())
//                ->first();
//
//            if (!$user) {
//                $user = User::where('email', $socialUser->getEmail())->first();
//
//                if ($user) {
//                    $user->update([
//                        'provider' => $provider,
//                        'provider_id' => $socialUser->getId(),
//                        'provider_token' => $socialUser->token,
//                    ]);
//                } else {
//                    $user = User::create([
//                        'name' => $socialUser->getName(),
//                        'email' => $socialUser->getEmail(),
//                        'username' => $socialUser->getName(),
//                        'password' => Hash::make(Str::random(10)),
//                        'provider' => $provider,
//                        'provider_id' => $socialUser->getId(),
//                        'provider_token' => $socialUser->token,
//                    ]);
//
//                    $user->sendEmailVerificationNotification();
//                }
//            }
//
//            $token = $user->createToken('auth_token')->plainTextToken;
//
//            return response()->json([
//                'message' => 'Login successful',
//                'access_token' => $token,
//                'token_type' => 'Bearer',
//                'user' => $user,
//            ]);
//
//        } catch (InvalidStateException $e) {
//            return response()->json(['error' => 'Invalid OAuth state.'], 400);
//        } catch (\Exception $e) {
//            return response()->json(['error' => $e->getMessage()], 500);
//        }
//    }
}
