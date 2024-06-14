<?php

namespace App\Http\Controllers;

use App\Models\Gradebook;
use App\Models\Module;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
