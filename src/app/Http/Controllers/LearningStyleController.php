<?php

namespace App\Http\Controllers;

use App\Models\Learning_Styles;
use Illuminate\Http\Request;

class LearningStyleController extends Controller
{
    public function addLearningStyle(Request $request) {
        $learning_style = new Learning_Styles();
        $learning_style->name = $request->learning_style_name;
        $learning_style->description = $request->learning_style_description;
        $learning_style->save();
        return redirect('/learning_styles')->with('status', 'Learning Style Created!');
    }
    public function updateLearningStyle(Request $request) {
        $learning_style = Learning_Styles::findOrFail($request->learning_style_id);
        $learning_style->name = $request->learning_style_name;
        $learning_style->description = $request->learning_style_description;
        $learning_style->save();
        return redirect("/ls_information/{$request->learning_style_id}")->with('status', 'Learning Style Updated!');
    }
    public function deleteLearningStyle(Request $request){
        $learning_style = Learning_Styles::findOrFail($request->learning_style_id);
        $learning_style->delete();
        return redirect('/learning_styles')->with('status', 'Learning Style Deleted!');
    }
    public static function getLearningStyles() {
        return Learning_Styles::all();
    }
    public static function showLearningStyles() {
        return view('sessions.admin.learning_styles', ['learning_styles' => Learning_Styles::all()]);
    }
    public static function lsInformationRead($id) {
        return view('sessions.admin.ls_information_readonly', ['lstyle' => Learning_Styles::find($id)]);
    }
    public static function lsInformation($id) {
        return view('sessions.admin.ls_information', ['lstyle' => Learning_Styles::find($id)]);
    }
}
