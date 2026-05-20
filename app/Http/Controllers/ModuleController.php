<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Quiz;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function CreateModule(Request $request)  {
        $module = new Module();
        $module->course = $request->course;
        $module->name = $request->name;
        $module->description = $request->description;
        $module->status = 'Pending';
        $module->content_path = 'N/A';
        $module->available_on = $request->available_on;
        $module->not_available = $request->not_available;
        $module->save();
        return redirect("/course_information/{$request->course}")->with('status', 'Module Created!');
    }
    public function UpdateModule(Request $request) {
        $module = Module::findorfail($request->module_id);
        $module->name = $request->name;
        $module->status = $request->status;
        $module->description = $request->description;
        $module->available_on = $request->available_on;
        $module->not_available = $request->not_available;
        $module->save();
        return redirect("/module_information/{$request->module_id}")->with('status', 'Module Updated!');
    }
    public static function moduleInformation($id) {
        $filepath = "modules/".str_replace(" ", "_", Module::find($id)->name)."/".str_replace(" ", "_", Module::find($id)->name).".mp4";

        return view('sessions.admin.module_information', [
            'module' => Module::findorfail($id),
            'filepath' => $filepath,
            'quizzes' => Quiz::where('module_id', '=', $id)->first()->quiz ?? NULL,
            'avg_grade' => GradebookController::getAverageModuleGrade($id),
            'last_graded' => GradebookController::getLastModuleGrade($id)
        ]);
    }
    public static function moduleInformationRead($id) {
        $filepath = "modules/".str_replace(" ", "_", Module::find($id)->name)."/".str_replace(" ", "_", Module::find($id)->name).".mp4";

        return view('sessions.admin.module_information_readonly', [
            'module' => Module::findorfail($id),
            'filepath' => $filepath,
            'quizzes' => Quiz::where('module_id', '=', $id)->first()->quiz ?? NULL,
            'avg_grade' => GradebookController::getAverageModuleGrade($id),
            'last_graded' => GradebookController::getLastModuleGrade($id)
        ]);
    }
}
