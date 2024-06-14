<?php

namespace App\Http\Controllers;

use App\Models\Gradebook;
use App\Models\Module;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GradebookController extends Controller
{
    public function gradeQuiz(Request $request){

        $quiz = Quiz::find($request->quiz);
        $total = 100;
        $num_questions = $quiz->num_questions;
        $increment = $total / $num_questions;
        for($i = 1; $i <= $num_questions; $i++){
            if($quiz->{"q" . $i . "_correct"} != $request->{"q" . $i}) {
                $total = $total - $increment;
            }
        }

        if($request->content_type == 'class'){
            if(Gradebook::where('user', '=', Auth::id())->where('class', '=', $request->class)->get()->isNotEmpty()){
                $grade = Gradebook::where('user', '=', Auth::id())->where('class', '=', $request->class)->first()->id;
                $grade = Gradebook::find($grade);
                $grade->class = $request->class;
                $grade->grade = $total;
                $grade->save();
                return redirect("/view_class/$request->class");
            };
            $grade = new Gradebook();
            $grade->user = Auth::id();
            $grade->class = $request->class;
            $grade->grade = $total;
            $grade->save();
            return redirect("/view_class/$request->class");
        } else {
            if(Gradebook::where('user', '=', Auth::id())->where('module', '=', $request->module)->get()->isNotEmpty()){
                $grade = Gradebook::where('user', '=', Auth::id())->where('module', '=', $request->module)->first()->id;
                $grade = Gradebook::find($grade);
                $grade->module = $request->module;
                $grade->grade = $total;
                $grade->save();
                return redirect("/view_course/".Module::find($request->module)->course."/view_module/$request->module");
            };
            $grade = new Gradebook();
            $grade->user = Auth::id();
            $grade->course = Module::find($request->module)->course;
            $grade->module = $request->module;
            $grade->grade = $total;
            $grade->save();
            return redirect("/view_course/".Module::find($request->module)->course."/view_module/$request->module");
        }
    }
    public static function getAverageClassGrade($id) {
        $grades = Gradebook::where('class', '=', $id)->get();
        if($grades->isEmpty()) return 0;
        return $grades->sum('grade') / Gradebook::where('class', '=', $id)->count();
    }
    public static function getAverageCourseGrade($id) {
        $grades = Gradebook::where('course', '=', $id)->get();
        if($grades->isEmpty()) return 0;
        return $grades->sum('grade') / Gradebook::where('class', '=', $id)->count();
    }
    public static function getAverageModuleGrade($id) {
        $grades = Gradebook::where('module', '=', $id)->get();
        if($grades->isEmpty()) return 0;
        return $grades->sum('grade') / Gradebook::where('class', '=', $id)->count();
    }
    public static function getLastClassGrade($id) {
        $last_updated = Gradebook::where('class', '=', $id)->orderby('updated_at', 'desc')->first();
        return $last_updated == NULL ? "No Graded Quizzes" : $last_updated->updated_at;
    }
    public static function getLastCourseGrade($id) {
        $last_updated = Gradebook::where('course', '=', $id)->orderby('updated_at', 'desc')->first();
        return $last_updated == NULL ? "No Graded Quizzes" : $last_updated->updated_at;
    }
    public static function getLastModuleGrade($id) {
        $last_updated = Gradebook::where('module', '=', $id)->orderby('updated_at', 'desc')->first();
        return $last_updated == NULL ? "No Graded Quizzes" : $last_updated->updated_at;
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
        if(Gradebook::where('user', '=', $user)->count() != 0) {
            return (Gradebook::where('user', '=', $user)->sum('grade') / Gradebook::where('user', '=', $user)->count());
        }
        return 0;
    }
}
