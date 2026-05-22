<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function login(Request $request) {
        $throttleKey = $this->throttleKey($request);

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            throw ValidationException::withMessages([
                'username' => trans('auth.throttle', ['seconds' => $seconds]),
            ])->status(429);
        }

        $attributes = $request->validate([
            'username' => ['required','exists:users,username'],
            'password' => ['required'],
        ]);
        if(auth()->attempt($attributes)) {
            RateLimiter::clear($throttleKey);
            session()->regenerate();
            $user = User::find(Auth::id());
            $user->last_active = date('Y-m-d');
            $user->save();
            return redirect('/home');
        }
        RateLimiter::hit($throttleKey, 60);

        throw ValidationException::withMessages([
            'username'=>'Invalid Username/Password'
        ]);
    }
    public function logout() {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    }

    private function throttleKey(Request $request): string
    {
        return Str::transliterate(
            Str::lower((string) $request->input('username')).'|'.$request->ip()
        );
    }
}
