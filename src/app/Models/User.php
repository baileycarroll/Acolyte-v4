<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function department() {
        return $this->belongsToMany(Department::class);
    }
    public function learning_style() {
        return $this->belongsTo(Learning_Style::class);
    }
    public function membership() {
        return $this->belongsTo(Licenses::class);
    }
    public function classes() {
        return $this->hasMany(Classes::class);
    }
    public function courses() {
        return $this->hasMany(Course::class);
    }
    public function award() {
        return $this->hasMany(User_Award::class);
    }
    public function gradebook() {
        return $this->hasMany(Gradebook::class);
    }
    public function content() {
        return $this->hasMany(User_Content::class);
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
//    Getting User information from the DB for the search bar:
//    User::where("first_name", "like", "%coly%")->orWhere("last_name", "like", "%aile%")->get()
//    I can chain together orwhere for global scopes and allow searching of several fields.
    public static function ajaxUsers() {
        $users = User::getUsersManagement();
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
}
