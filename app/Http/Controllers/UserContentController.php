<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Classes;
use App\Models\Content_Types;
use App\Models\Course;
use App\Models\Gradebook;
use App\Models\Module;
use App\Models\Quiz;
use App\Models\SetupKeys;
use App\Models\User;
use App\Models\User_Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserContentController extends Controller
{
    public static function addUserToContent(Request $request){
        $content_added = new User_Content();
        if($request->type === 'course') {
            $content_added->user = Auth::id();
            $content_added->course = $request->course;
            $content_added->save();
        }
        if($request->type === 'class') {
            $content_added->user = Auth::id();
            $content_added->class = $request->class;
            $content_added->save();
        }
        return redirect('/home')->with('status', 'Content added successfully!');
    }
    public function addUserToClass(Request $request){
        if(User_Content::where('user', '=', $request->user)->where('class', '=', $request->class)->get()->isNotEmpty()){
            return redirect("/user_information/{$request->user}")->with('error', 'User already has access to class...');
        }
        $new_content = new User_Content();
        $new_content->user = $request->user;
        $new_content->class = $request->class;
        $new_content->save();
        return redirect("/user_information/{$request->user}")->with('status', 'User added to class!');
    }
    public static function getUsersCourses($user){
        $courses = DB::table('courses')
            ->leftJoin('user_content', 'user_content.course', '=', 'courses.id')
            ->where('user_content.user', '=', $user)
            ->select('courses.id', 'courses.name', 'courses.updated_at')
            ->get()
            ->toArray();
        return array_values($courses);
    }
    public static function showCatalog() {
        if(request('content_type')) {
            if(request('content_type') === 'Class'){
                return view('sessions.user.course_catalog', [
                    'contents' => Classes::where("status", '=', 'Active')->get(),
                    'user_contents' => User_Content::where('user', '=', Auth::id())->get(),
                    'categories' => Category::all(),
                    'content_types' => Content_Types::all(),
                ]);
            } else {
                return view('sessions.user.course_catalog', [
                    'contents' => Course::where("status", '=', 'Active')->get(),
                    'user_contents' => User_Content::where('user', '=', Auth::id())->get(),
                    'categories' => Category::all(),
                    'content_types' => Content_Types::all(),
                ]);
            }
        } else
            if(request('category')) {
                return view('sessions.user.course_catalog', [
                    $courses = Course::where("status", '=', 'Active')->where('category_1', '=', request('category'))->orWhere('category_2', '=', request('category'))->orWhere('category_3', '=', request('category')),
                    'contents' => Classes::where("status", '=', 'Active')->where('category_1', '=', request('category'))->orWhere('category_2', '=', request('category'))->orWhere('category_3', '=', request('category'))->get()->merge($courses),
                    'user_contents' => User_Content::where('user', '=', Auth::id())->get(),
                    'categories' => Category::all(),
                    'content_types' => Content_Types::all(),
                ]);
            } else {
                return view('sessions.user.course_catalog', [
                    $courses = Course::where("status", '=', 'Active'),
                    'contents' => Classes::where("status", '=', 'Active')->get()->merge($courses),
                    'user_contents' => User_Content::where('user', '=', Auth::id())->get(),
                    'categories' => Category::all(),
                    'content_types' => Content_Types::all(),
                ]);
            }
    }
    public static function viewClass($id) {
        $last_active = User_Content::where('user', '=', Auth::id())->where('class', '=', $id)->first();
        $last_active->last_accessed = date('Y-m-d');
        $last_active->save();

        if(Gradebook::where('user', '=', Auth::id())->where('class', '=', $id)->get()->isEmpty()){
            $show_quiz = 1;
            $grade = NULL;
        } else {
            $show_quiz = 0;
            $grade = Gradebook::where('user', '=', Auth::id())->where('class', '=', $id)->first()->grade;
        }
        if(SetupKeys::where('key', '=', 'allow_class_retakes')->where('value', '=', 1)->first()->value ?? false) {
            $show_quiz = 1;
        }
        if (Quiz::where('class_id', '=', $id)->first() != NULL) {
            return view('sessions.user.view_class', [
                'class' => Classes::find($id),
                'content' => "classes/".str_replace(" ", "_", Classes::find($id)->name)."/".str_replace(" ", "_", Classes::find($id)->name).".mp4",
                'quiz' => Quiz::where('class_id', '=', $id)->first(),
                'show_quiz' => $show_quiz,
                'grade' => $grade,
                'related_classes' => ContentController::getRelatedContent('class', $id),
                'related_modules' => ContentController::getRelatedContent('module', $id)
            ]);
        }
        return view('sessions.user.view_class', [
            'class' => Classes::find($id),
            'content' => "classes/".str_replace(" ", "_", Classes::find($id)->name)."/".str_replace(" ", "_", Classes::find($id)->name).".mp4",
            'quiz' => NULL,
            'show_quiz' => $show_quiz,
            'grade' => $grade,
            'related_classes' => ContentController::getRelatedContent('class', $id),
            'related_modules' => ContentController::getRelatedContent('module', $id)
        ]);
    }
    public static function viewCourse($id) {
        return view('sessions.user.view_course', [
            'course' => Course::find($id),
            'modules' => Module::where('course', '=', $id)->where('status', '=', 'Active')->get(),
        ]);
    }
    public static function viewModule($course_id, $module_id) {
        $last_active = User_Content::where('user', '=', Auth::id())->where('course', '=', $course_id)->first();
        $last_active->last_accessed = date('Y-m-d');
        $last_active->save();

        if(Gradebook::where('user', '=', Auth::id())->where('course', '=', $course_id)->where('module', '=', $module_id)->get()->isEmpty()){
            $show_quiz = 1;
            $grade = NULL;
        } else {
            $show_quiz = 0;
            $grade = Gradebook::where('user', '=', Auth::id())->where('course', '=', $course_id)->where('module', '=', $module_id)->first()->grade;
        }
        if(SetupKeys::where('key', '=', 'allow_class_retakes')->where('value', '=', 1)->first()->value ?? false) {
            $show_quiz = 1;
        }
        if (Quiz::where('module_id', '=', $module_id)->first() != NULL) {
            return view('sessions.user.view_course_module', [
                'modules' => Module::where('course', '=', $course_id)->where('status', '=', 'Active')->where('id', '!=', $module_id)->get(),
                'course' => Course::find($course_id),
                'module' => Module::find($module_id),
                'content' => "modules/".str_replace(" ", "_", Module::find($module_id)->name)."/".str_replace(" ", "_", Module::find($module_id)->name).".mp4",
                'quiz' => Quiz::where('module_id', '=', $module_id)->first(),
                'show_quiz' => $show_quiz,
                'grade' => $grade,
                'related_classes' => ContentController::getRelatedContent('class', $module_id),
                'related_modules' => ContentController::getRelatedContent('module', $module_id)
            ]);
        }
        return view("sessions.user.view_course_module", [
            'modules' => Module::where('course', '=', $course_id)->where('status', '=', 'Active')->where('id', '!=', $module_id)->get(),
            'course' => Course::find($course_id),
            'module' => Module::find($module_id),
            'content' => "modules/".str_replace(" ", "_", Module::find($module_id)->name)."/".str_replace(" ", "_", Module::find($module_id)->name).".mp4",
            'quiz' => NULL,
            'show_quiz' => $show_quiz,
            'grade' => $grade,
            'related_classes' => ContentController::getRelatedContent('class', $module_id),
            'related_modules' => ContentController::getRelatedContent('module', $module_id)
        ]);

    }
    public static function showUsersContent() {
        return view('sessions.user.my_content', ['classes' => Classes::all(), 'courses' => Course::all()]);
    }
}
