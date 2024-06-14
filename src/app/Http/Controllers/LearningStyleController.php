<?php

namespace App\Http\Controllers;

use App\Models\Learning_Style;
use Illuminate\Http\Request;

class LearningStyleController extends Controller
{
    public function addLearningStyle(Request $request) {
        $learning_style = new Learning_Style();
        $learning_style->name = $request->learning_style_name;
        $learning_style->description = $request->learning_style_description;
        $learning_style->save();
        return redirect('/learning_styles')->with('status', 'Learning Style Created!');
    }
    public function updateLearningStyle(Request $request) {
        $learning_style = Learning_Style::findOrFail($request->learning_style_id);
        $learning_style->name = $request->learning_style_name;
        $learning_style->description = $request->learning_style_description;
        $learning_style->save();
        return redirect("/ls_information/{$request->learning_style_id}")->with('status', 'Learning Style Updated!');
    }
    public function deleteLearningStyle(Request $request){
        $learning_style = Learning_Style::findOrFail($request->learning_style_id);
        $learning_style->delete();
        return redirect('/learning_styles')->with('status', 'Learning Style Deleted!');
    }
}
