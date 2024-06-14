<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classes extends Model
{
    use HasFactory;

    protected $guarded = ['status'];

    public static function getClassesAdmin() {
        return Classes::query()
            ->leftJoin('categories', 'classes.category_1', '=', 'categories.id')
            ->leftJoin('departments', 'classes.department', '=', 'departments.id')
            ->leftJoin('users', 'classes.instructor', '=', 'users.id')
            ->leftJoin('learning_styles', 'classes.learning_style', '=', 'learning_styles.id')
            ->select('classes.id', 'classes.name', 'classes.excerpt', 'classes.status', 'departments.name as department_name', 'users.last_name as instructor_name', 'learning_styles.name as ls_name', 'classes.updated_at')->get();
    }
    public static function getClasses() {
        return Classes::query()
            ->leftJoin('categories', 'classes.category_1', '=', 'categories.id')
            ->leftJoin('departments', 'classes.department', '=', 'departments.id')
            ->leftJoin('users', 'classes.instructor', '=', 'users.id')
            ->leftJoin('learning_styles', 'classes.learning_style', '=', 'learning_styles.id')
            ->select('classes.id', 'classes.name', 'classes.excerpt', 'classes.status', 'departments.name as department_name', 'users.last_name as instructor_name', 'learning_styles.name as ls_name', 'classes.updated_at')->get()->toArray();
    }

    public static function getClassesUpdateAdmin($id) {
        return Classes::query()
            ->leftJoin('categories', 'classes.category_1', '=', 'categories.id')
            ->leftJoin('departments', 'classes.department', '=', 'departments.id')
            ->leftJoin('users', 'classes.instructor', '=', 'users.id')
            ->leftJoin('learning_styles', 'classes.learning_style', '=', 'learning_styles.id')
            ->select('classes.id', 'classes.name', 'classes.excerpt', 'classes.description' , 'classes.status', 'classes.learning_style', 'classes.department', 'departments.name as department_name', 'classes.instructor', 'users.first_name as instructor_fname', 'users.last_name as instructor_lname', 'learning_styles.name as ls_name', 'classes.category_1', 'categories.name as category_name', 'classes.updated_at')
            ->where('classes.id', '=', $id)->first();
    }
    public static function getUsersWithClass($id) {
        return DB::table('user_content')
            ->leftJoin('users', 'user_content.user', '=', 'users.id')
            ->where('user_content.class', '=', $id)
            ->select('users.id as user_id', 'users.first_name', 'users.last_name', 'users.email', 'users.phone', 'users.user_status')
            ->get()
            ->toArray();
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }
    public function users() {
        return $this->belongsToMany(User::class);
    }
    public function learning_style() {
        return $this->hasOne(Learning_Style::class);
    }
    public function category() {
        return $this->belongsToMany(Category::class);
    }
    public function gradebook(){
        return $this->hasMany(Gradebook::class);
    }
    public function content() {
        return $this->hasMany(User_Content::class, 'class');
    }
}
