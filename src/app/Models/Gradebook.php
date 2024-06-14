<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
