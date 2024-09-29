<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\Classes;
use App\Models\Licenses;
use App\Models\User_Content;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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
    public static function getUsersManagement() {
        return User::query()
            ->leftJoin('departments', 'users.primary_department', '=', 'departments.id')
            ->leftJoin('learning_styles', 'users.learning_style', '=', 'learning_styles.id')
            ->leftJoin('licenses', 'users.license', '=', 'licenses.id')
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.preferred_name', 'users.phone',
                'users.email', 'users.primary_department as department_id',
                'departments.name as user_department', 'users.user_status', 'users.last_active',
                'users.learning_style as ls_id','learning_styles.name as ls_name',
                'users.license as lic_id','licenses.name as lic_name', 'users.license_ends', 'users.updated_at')->get();
    }
    public static function getUserInformation($id) {
        return User::query()
            ->leftJoin('departments', 'users.primary_department', '=', 'departments.id')
            ->leftJoin('learning_styles', 'users.learning_style', '=', 'learning_styles.id')
            ->leftJoin('licenses', 'users.license', '=', 'licenses.id')
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.preferred_name', 'users.phone',
                'users.email', 'users.primary_department as department_id',
                'departments.name as user_department', 'users.user_status', 'users.last_active',
                'users.learning_style as ls_id','learning_styles.name as ls_name',
                'users.license as lic_id','licenses.name as lic_name', 'users.license_ends', 'users.updated_at')
            ->where('users.id', $id)
            ->first();
    }
    public static function getActiveUsers() {
        return User::where('user_status', '=', 'Active')->count();
    }
    public static function getTodaysUsers(){
        return User::where('last_active', '>=', date('Y-m-d'))->count();
    }
    public static function getInactiveUsers() {
        return User::where('user_status', '!=', 'Active')->count();
    }
    public static function getCountUsersWithDepts() {
        return User::query()->whereNotNull('primary_department')->count();
    }
    public static function getCountUsersWithoutDepts() {
        return User::query()->whereNull('primary_department')->count();
    }
    public static function ajaxUsers() {
        $users = self::getUsersManagement();
        $users = $users->toArray();
        return array_values($users);
    }
    public static function getUsersWithRole($id) {
        $users = DB::table('roles')
            ->leftJoin('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->leftJoin('users', 'users.id', '=', 'model_has_roles.model_id')
            ->where('model_has_roles.model_type', '=', 'App\Models\User')
            ->where('model_has_roles.role_id', '=', $id)
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.phone', 'users.user_status')
            ->get()->toArray();
        return array_values($users);
    }

    public static function showUsers() {
        return view('sessions.admin.users', [
            'active_users' => UserController::getActiveUsers(),
            'inactive_users' => UserController::getInactiveUsers(),
            'todays_users' => UserController::getTodaysUsers(),
            'departments' => DepartmentController::getDepartments(),
            'licenses' => Licenses::all(),
            'learning_styles' => LearningStyleController::getLearningStyles(),
        ]);
    }
    public static function userInformation($id) {
        return view('sessions.admin.user_information', [
            'user' => self::getUserInformation($id),
            'departments' => DepartmentController::getDepartments(),
            'licenses' => Licenses::all(),
            'awards' => Award::all(),
            'learning_styles' => LearningStyleController::getLearningStyles(),
            'user_roles' => User::find($id)->roles->pluck('name'),
            'roles' => Role::where('id', '!=', 1)->get(),
            'classes' => Classes::all(),
            'average_grade' => GradebookController::calculateAverage($id),
        ]);
    }
    public static function userInformationRead($id) {
        return view('sessions.admin.user_information_readonly', [
            'user' => self::getUserInformation($id),
            'departments' => DepartmentController::getDepartments(),
            'licenses' => Licenses::all(),
            'awards' => Award::all(),
            'learning_styles' => LearningStyleController::getLearningStyles(),
            'user_roles' => User::roles()->name,
            'roles' => Role::where('id', '!=', 1)->get(),
            'classes' => Classes::all(),
            'average_grade' => GradebookController::calculateAverage(),
        ]);
    }
    public static function showProfile() {
        return view('sessions.user.my_profile', [
            'licenses' => Licenses::where('trial', '=', 0)->where('admin', '=', 0)->get(),
            'intent' => MembershipController::createPaymentMethod(),
            'user' => User::find(Auth::id())
        ]);
    }
    public static function updateAccount(Request $request) {
        $user = User::find(Auth::id());
        $user -> first_name = $request->first_name;
        $user -> last_name = $request->last_name;
        $user -> preferred_name = $request->preferred_name;
        $user -> email = $request->email;
        $user -> phone = $request->phone;
        $user->save();
        return redirect('/my_profile')->with('status', 'Account Details Updated');
    }
}
