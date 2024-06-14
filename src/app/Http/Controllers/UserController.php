<?php

namespace App\Http\Controllers;

use App\Models\User_Content;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function adminAddUser(Request $request) {
        $user = new User;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->primary_department = $request->department;
        $user->user_status = $request->user_status;
        $user->learning_style = $request->learning_style;
        $user->license = $request->license;
        $user->license_ends = $request->license_ends;
        $user->save();
        $user->assignRole('User');
        return redirect('/users')->with('status', 'User Created!');
    }
    public function adminDelUser($id){
        User::findorfail($id)->delete();
        return redirect('/users')->with('status', 'User Deleted!');
    }
    public function adminUpdateUser(Request $request) {
        $user = User::findOrFail($request->user_id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->primary_department = $request->department;
        $user->user_status = $request->user_status;
        $user->learning_style = $request->learning_style;
        $user->license = $request->license;
        $user->license_ends = $request->license_ends;
        $user->save();
        $user->syncRoles($request->roles);
        return redirect("/user_information/{$request->user_id}")->with('status', 'User Updated!');
    }
    public function addRole($user_id, $role_id) {
        User::find($user_id)->assignRole($role_id);
        return redirect("/user_information/{$user_id}")->with('status', 'User Role(s) Updated');
    }
}
