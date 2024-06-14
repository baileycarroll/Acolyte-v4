<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Classes;
use App\Models\Content_Types;
use App\Models\Department;
use App\Models\Learning_Styles;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
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
        $class->content_type = Content_Types::where('name', '=', 'Class')->first()->id;
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
    public static function getClassesAdmin() {
        return Classes::query()
            ->leftJoin('categories', 'classes.category_1', '=', 'categories.id')
            ->leftJoin('departments', 'classes.department', '=', 'departments.id')
            ->leftJoin('users', 'classes.instructor', '=', 'users.id')
            ->leftJoin('learning_styles', 'classes.learning_style', '=', 'learning_styles.id')
            ->select('classes.id', 'classes.name', 'classes.excerpt', 'classes.status', 'departments.name as department_name', 'users.last_name as instructor_name', 'learning_styles.name as ls_name', 'classes.updated_at')->get();
    }
    public static function getClasses() {
        return Classes::query()
            ->leftJoin('categories', 'classes.category_1', '=', 'categories.id')
            ->leftJoin('departments', 'classes.department', '=', 'departments.id')
            ->leftJoin('users', 'classes.instructor', '=', 'users.id')
            ->leftJoin('learning_styles', 'classes.learning_style', '=', 'learning_styles.id')
            ->select('classes.id', 'classes.name', 'classes.excerpt', 'classes.status', 'departments.name as department_name', 'users.last_name as instructor_name', 'learning_styles.name as ls_name', 'classes.updated_at')->get()->toArray();
    }

    public static function getClassesUpdateAdmin($id) {
        return Classes::query()
            ->leftJoin('categories', 'classes.category_1', '=', 'categories.id')
            ->leftJoin('departments', 'classes.department', '=', 'departments.id')
            ->leftJoin('users', 'classes.instructor', '=', 'users.id')
            ->leftJoin('learning_styles', 'classes.learning_style', '=', 'learning_styles.id')
            ->select('classes.id', 'classes.name', 'classes.excerpt', 'classes.description' , 'classes.status', 'classes.learning_style', 'classes.department', 'departments.name as department_name', 'classes.instructor', 'users.first_name as instructor_fname', 'users.last_name as instructor_lname', 'learning_styles.name as ls_name', 'classes.category_1', 'categories.name as category_name', 'classes.updated_at')
            ->where('classes.id', '=', $id)->first();
    }
    public static function getUsersWithClass($id) {
        return DB::table('user_content')
            ->leftJoin('users', 'user_content.user', '=', 'users.id')
            ->where('user_content.class', '=', $id)
            ->select('users.id as user_id', 'users.first_name', 'users.last_name', 'users.email', 'users.phone', 'users.user_status')
            ->get()
            ->toArray();
    }
    public static function showClasses() {
        return view('sessions.admin.classes', [
            'classes' => self::getClassesAdmin(),
            'learning_styles' => Learning_Styles::all(),
            'departments' => Department::all(),
            'categorys' => Category::all(),
            'instructors' => User::all()
        ]);
    }
    public static function classInformationRead($id) {
        return view('sessions.admin.class_information_readonly', [
           'class' => self::getClassesUpdateAdmin($id),
            'learning_styles' => Learning_Styles::all(),
            'departments' => Department::all(),
            'categorys' => Category::all(),
            'instructors' => User::all(),
            'class_name' => str_replace(" ", "_", Classes::find($id)->name),
            'thumb_filepath' => "thumbnails/classes/".Classes::find($id)->name."/".Classes::find($id)->name.".jpg",
            'filepath' => "classes/".str_replace(" ", "_", Classes::find($id)->name)."/".str_replace(" ", "_", Classes::find($id)->name).".mp4",
            'quizzes' => Quiz::all()->where('class_id', '=', $id),
            'avg_grade' => GradebookController::getAverageClassGrade($id),
            'last_graded' => GradebookController::getLastClassGrade($id),
        ]);
    }
    public static function classInformation($id) {
        return view('sessions.admin.class_information', [
            'class' => self::getClassesUpdateAdmin($id),
            'learning_styles' => Learning_Styles::all(),
            'departments' => Department::all(),
            'categorys' => Category::all(),
            'instructors' => User::all(),
            'class_name' => str_replace(" ", "_", Classes::find($id)->name),
            'thumb_filepath' => "thumbnails/classes/".Classes::find($id)->name."/".Classes::find($id)->name.".jpg",
            'filepath' => "classes/".str_replace(" ", "_", Classes::find($id)->name)."/".str_replace(" ", "_", Classes::find($id)->name).".mp4",
            'quizzes' => Quiz::all()->where('class_id', '=', $id),
            'avg_grade' => GradebookController::getAverageClassGrade($id),
            'last_graded' => GradebookController::getLastClassGrade($id),
        ]);
    }
}
