<?php

namespace App\Http\Controllers;

use App\Models\Learning_Style;
use App\Models\Licenses;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function createUser(Request $request) {
//        Validate Input from Register Form
//        If Validation Successful Create User and Login
//        If Failed, throw error and send back to register page with all but password.
        $attributes = $request->validate([
            "first_name" => ['required', 'max:255'],
            "last_name" => ['required', 'max:255'],
            "username" => ['required', 'unique:users,username', 'max:255'],
            "email" => ['required', 'unique:users,email', 'max:255', 'email'],
            "password" => ['required', 'min:6', 'max:255']
        ]);


//        Create the User
        $user = User::create([
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
            'username' => $attributes['username'],
            'password' => bcrypt($attributes['password']),
            'primary_department' => Department::where('name', '=', "Support")->first()->id,
            'user_status' => 'Active',
            'learning_style' => Learning_Style::where('name', '=', "Unknown")->first()->id,
            'license' => Licenses::where('name', '=', "Trial")->first()->id,
            'license_starts' => date("Y-m-d"),
            'license_ends' => date('Y-m-d', strtotime(" +1 year")),
            'license_origin' => date('Y-m-d')
        ]);

//      Log in the user
        auth()->login($user);
        $user->assignRole('User');

        return redirect('/home');
    }
}
