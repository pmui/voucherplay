<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthWithGoogleController extends Controller
{
    public function login()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $email = $user->getEmail();
            $name = $user->getName();
            $avatar = $user->getAvatar();

            $check_user = User::where('email', $email)->first();

            if ($check_user) {
                // Email exists, perform login action
                Auth::login($check_user);
                // You can redirect the user to a dashboard or any other page after successful login
                return redirect(route('home'));
            } else {
                // Email does not exist, perform registration action
                $new_user = new User();
                $new_user->name = $name;
                $new_user->email = $email;
                $new_user->avatar = $avatar;
                $new_user->password = bcrypt(now()); // You should use proper password hashing
                $new_user->save();

                // Perform login for the newly registered user
                Auth::login($new_user);
                // You can redirect the user to a dashboard or any other page after successful registration and login
                return redirect(route('home'));
            }
        } catch (\Exception $e) {
            // Error occurred, redirect to login page with an error message
            return redirect(route('login'))->with('error', 'Failed to authenticate with Google. Please try again.');
        }
    }

}
