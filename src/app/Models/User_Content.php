<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User_Content extends Model
{
    use HasFactory;
    protected $table = 'user_content';

    public static function getUsersCourses($user){
        $courses = DB::table('courses')
            ->leftJoin('user_content', 'user_content.course', '=', 'courses.id')
            ->where('user_content.user', '=', $user)
            ->select('courses.id', 'courses.name', 'courses.updated_at')
            ->get()
            ->toArray();
        return array_values($courses);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function course() {
        return $this->belongsToMany(Course::class);
    }
    public function classes() {
        return $this->belongsToMany(Classes::class);
    }
}
