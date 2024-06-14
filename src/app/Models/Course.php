<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public static function getCourses() {
        return Course::query()
            ->leftJoin('categories', 'courses.category_1', '=', 'categories.id')
            ->leftJoin('departments', 'courses.department', '=', 'departments.id')
            ->leftJoin('users', 'courses.instructor', '=', 'users.id')
            ->leftJoin('learning_styles', 'courses.learning_style', '=', 'learning_styles.id')
            ->select('courses.id', 'courses.name', 'courses.excerpt', 'courses.status', 'departments.name as department_name', 'users.last_name as instructor_name', 'learning_styles.name as ls_name', 'courses.updated_at')->get()->toArray();
    }
    public static function getCoursesUpdateAdmin($id) {
        return Course::query()
            ->leftJoin('categories', 'courses.category_1', '=', 'categories.id')
            ->leftJoin('departments', 'courses.department', '=', 'departments.id')
            ->leftJoin('users', 'courses.instructor', '=', 'users.id')
            ->leftJoin('learning_styles', 'courses.learning_style', '=', 'learning_styles.id')
            ->select('courses.id', 'courses.name', 'courses.excerpt', 'courses.description' , 'courses.status', 'courses.learning_style', 'courses.department', 'departments.name as department_name', 'courses.instructor', 'users.first_name as instructor_fname', 'users.last_name as instructor_lname', 'learning_styles.name as ls_name', 'courses.category_1', 'categories.name as category_name', 'courses.updated_at')
            ->where('courses.id', '=', $id)->first();
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }
    public function users() {
        return $this->belongsTo(User::class);
    }
    public function learning_style() {
        return $this->hasOne(Learning_Style::class);
    }
    public function category() {
        return $this->hasMany(Category::class);
    }
    public function gradebook() {
        return $this->hasMany(Gradebook::class);
    }
    public function content() {
        return $this->hasMany(User_Content::class, 'course');
    }
}
