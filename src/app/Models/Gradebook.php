<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Gradebook extends Model
{
    use HasFactory;
    protected $table = 'gradebook';


    public static function getAverageClassGrade($id) {
        $grades = Gradebook::where('class', '=', $id)->get();
        if($grades->isEmpty()) {
            return 0;
        }
        $count = Gradebook::where('class', '=', $id)->count();
        $sum = $grades->sum('grade');
        return $sum / $count;
    }
    public static function getAverageCourseGrade($id) {
        $grades = Gradebook::where('course', '=', $id)->get();
        if($grades->isEmpty()) {
            return 0;
        }
        $count = Gradebook::where('course', '=', $id)->count();
        $sum = $grades->sum('grade');
        return $sum / $count;
    }
    public static function getAverageModuleGrade($id) {
        $grades = Gradebook::where('module', '=', $id)->get();
        if($grades->isEmpty()) {
            return 0;
        }
        $count = Gradebook::where('module', '=', $id)->count();
        $sum = $grades->sum('grade');
        return $sum / $count;
    }
    public static function getLastClassGrade($id) {
        $last_updated = Gradebook::where('class', '=', $id)->orderby('updated_at', 'desc')->first();
        if($last_updated == NULL){
            return "No Graded Quizzes";
        }
        return $last_updated->updated_at;
    }
    public static function getLastCourseGrade($id) {
        $last_updated = Gradebook::where('course', '=', $id)->orderby('updated_at', 'desc')->first();
        if($last_updated == NULL){
            return "No Graded Quizzes";
        }
        return $last_updated->updated_at;
    }
    public static function getLastModuleGrade($id) {
       $last_updated = Gradebook::where('module', '=', $id)->orderby('updated_at', 'desc')->first();
        if($last_updated == NULL){
            return "No Graded Quizzes";
        }
        return $last_updated->updated_at;
    }

    public static function getTranscripts($user) {
        $class_grades = DB::table('gradebook')
            ->join('classes', 'classes.id', '=', 'gradebook.class')
            ->where('gradebook.user', '=', $user)
            ->select('classes.name', 'gradebook.grade', 'gradebook.updated_at');
        $grades = DB::table('gradebook')
            ->join('courses', 'courses.id', '=', 'gradebook.course')
            ->where('gradebook.user', '=', $user)
            ->select('courses.name', 'gradebook.grade', 'gradebook.updated_at')
            ->union($class_grades)
            ->get()
            ->toArray();
        return array_values($grades);
    }
    public static function calculateAverage($user) {
        $count_grades = Gradebook::where('user', '=', $user)->count();
        $sum_of_grades = Gradebook::where('user', '=', $user)->sum('grade');
        return ($sum_of_grades / $count_grades);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
    public function classes() {
        return $this->belongsToMany(Classes::class);
    }
    public function courses() {
        return $this->belongsToMany(Course::class);
    }
    public function module() {
        return $this->belongsToMany(Module::class);
    }
}
