<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = Usuarios::where('username', $googleUser->email)->first();

        //Si el usuario no existe lo creamos
        $googleId = $googleUser->getId();
        if(!$user)
        {
            $user = Usuarios::create([
                'username' => $googleUser->email,
                'password' => Hash::make(rand(100000,999999)),
                'google_id' => $googleId
            ]);

            Auth::login($user);
            return redirect(RouteServiceProvider::HOME);
        }

        //Si el usuario ya existe lo logeamos pero guardamos su google id
        $user->update([
            'google_id' => $googleId
        ]);



        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
