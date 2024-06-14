<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function createClassQuiz(Request $request){
        $quiz = new Quiz;
        $quiz->class_id = $request->class_id;
        $quiz->num_questions = $request->num_questions;
        for($i = 1; $i <= $request->num_questions; $i++){
            $quiz->{"question_". $i} = $request->{"question_".$i};
            $quiz->{"q".$i."_opt_1"} = $request->{"q".$i."_opt_1"};
            $quiz->{"q".$i."_opt_2"} = $request->{"q".$i."_opt_2"};
            $quiz->{"q".$i."_opt_3"} = $request->{"q".$i."_opt_3"};
            $quiz->{"q".$i."_correct"} = $request->{"q".$i."_correct"};
        }
        $quiz->save();
        return redirect("/class_information/{$request->class_id}")->with('status', 'Class Quiz Created!!');
    }
    public function updateClassQuiz(Request $request){
        $quiz = Quiz::find($request->quiz_id);
        $quiz->class_id = $request->class_id;
        $quiz->num_questions = $request->num_questions;
        for($i = 1; $i <= $request->num_questions; $i++){
            $quiz->{"question_". $i} = $request->{"question_".$i};
            $quiz->{"q".$i."_opt_1"} = $request->{"q".$i."_opt_1"};
            $quiz->{"q".$i."_opt_2"} = $request->{"q".$i."_opt_2"};
            $quiz->{"q".$i."_opt_3"} = $request->{"q".$i."_opt_3"};
            $quiz->{"q".$i."_correct"} = $request->{"q".$i."_correct"};
        }
        $quiz->save();
        return redirect("/class_information/{$request->class_id}")->with('status', 'Class Quiz Updated!!');
    }
    public function createModuleQuiz(Request $request) {
        $quiz = new Quiz;
        $quiz->module_id = $request->module_id;
        $quiz->num_questions = $request->num_questions;
        for($i = 1; $i <= $request->num_questions; $i++){
            $quiz->{"question_". $i} = $request->{"question_".$i};
            $quiz->{"q".$i."_opt_1"} = $request->{"q".$i."_opt_1"};
            $quiz->{"q".$i."_opt_2"} = $request->{"q".$i."_opt_2"};
            $quiz->{"q".$i."_opt_3"} = $request->{"q".$i."_opt_3"};
            $quiz->{"q".$i."_correct"} = $request->{"q".$i."_correct"};
        }
        $quiz->save();
        return redirect("/module_information/{$request->module_id}")->with('status', 'Module Quiz Created!!');
    }
    public function updateModuleQuiz(Request $request) {
        $quiz = Quiz::find($request->quiz_id);
        $quiz->num_questions = $request->num_questions;
        for($i = 1; $i <= $request->num_questions; $i++){
            $quiz->{"question_". $i} = $request->{"question_".$i};
            $quiz->{"q".$i."_opt_1"} = $request->{"q".$i."_opt_1"};
            $quiz->{"q".$i."_opt_2"} = $request->{"q".$i."_opt_2"};
            $quiz->{"q".$i."_opt_3"} = $request->{"q".$i."_opt_3"};
            $quiz->{"q".$i."_correct"} = $request->{"q".$i."_correct"};
        }
        $quiz->save();
        return redirect("/module_information/{$request->module_id}")->with('status', 'Module Quiz Updated!!');
    }
}
