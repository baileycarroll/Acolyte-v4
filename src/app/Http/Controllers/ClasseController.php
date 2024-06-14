<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function createClass(Request $request) {
        $class = new Classes();
        $class->name = $request->class_name;
        $class->excerpt = $request->class_excerpt;
        $class->description = $request->class_description;
        $class->category_1 = $request->category;
        $class->department = $request->department;
        $class->instructor = $request->instructor;
        $class->learning_style = $request->learning_style;
        $class->status = 'Pending';
        $class->content_path = 'N/A';
        $class->save();
        return redirect('/classes')->with('status', 'Class Created!');
    }

    public function updateClass(Request $request) {
        $class = Classes::findOrFail($request->class_id);
        $class->name = $request->class_name;
        $class->excerpt = $request->class_excerpt;
        $class->description = $request->class_description;
        $class->category_1 = $request->category;
        $class->department = $request->department;
        $class->instructor = $request->instructor;
        $class->learning_style = $request->learning_style;
        $class->status = $request->status;
        $class->save();
        return redirect("/class_information/{$request->class_id}")->with('status', 'Class Updated!');
    }
    public static function getClassName($id) {
        return Classes::find($id)->name;
    }


    public function deleteClass(Request $request) {
        $class = Classes::findorfail($request->class_id);
        $class->delete();
        return redirect('/classes')->with('status', 'Class Deleted!');
    }
}
