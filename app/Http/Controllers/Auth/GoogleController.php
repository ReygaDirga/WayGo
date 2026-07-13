<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')
        ->stateless()
        ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
        ->user();
        
        // UBAH updateOrCreate MENJADI firstOrCreate
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name'              => $googleUser->getName(),
                'google_id'         => $googleUser->getId(),
                'avatar'            => $googleUser->getAvatar(),
                'password'          => Hash::make('w@Y9o' .Str::studly($googleUser->getName())),
                'email_verified_at' => now(),
            ]
        );

        // Tambahan pengaman: Jika user lama (misal daftar manual) login via Google, 
        // kita tautkan google_id-nya tanpa menimpa namanya.
        if (!$user->wasRecentlyCreated && empty($user->google_id)) {
            $user->update(['google_id' => $googleUser->getId()]);
        }

        Auth::login($user);
        
        if ($user->wasRecentlyCreated) {
            return redirect()->route('profile.create');
        } else {
            return redirect()->route('home'); 
        }
    }
}