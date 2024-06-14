<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function login(Request $request) {

        $attributes = $request->validate([
            'username' => ['required','exists:users,username'],
            'password' => ['required'],
        ]);
        if(auth()->attempt($attributes)) {
            session()->regenerate();
            $user = User::find(Auth::id());
            $user->last_active = date('Y-m-d');
            $user->save();
            return redirect('/home');
        }
        throw ValidationException::withMessages([
            'username'=>'Invalid Username/Password'
        ]);
    }
    public function logout() {
        auth()->logout();
        return redirect('/login');
    }
}
