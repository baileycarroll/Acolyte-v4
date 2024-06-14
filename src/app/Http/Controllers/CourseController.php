<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Content_Types;
use App\Models\Course;
use App\Models\Department;
use App\Models\Learning_Styles;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function createCourse(Request $request) {
        $course = new Course();
        $course->name = $request->course_name;
        $course->excerpt = $request->course_excerpt;
        $course->description = $request->course_description;
        $course->category_1 = $request->category;
        $course->department = $request->department;
        $course->instructor = $request->instructor;
        $course->learning_style = $request->learning_style;
        $course->status = 'Pending';
        $course->content_type = Content_Types::where('name', '=', 'Course')->first()->id;
        $course->save();
        return redirect('/courses')->with('status', 'Course Created!');
    }

    public function updateCourse(Request $request) {
        $course = Course::findOrFail($request->course_id);
        $course->name = $request->course_name;
        $course->excerpt = $request->course_excerpt;
        $course->description = $request->course_description;
        $course->category_1 = $request->category;
        $course->department = $request->department;
        $course->instructor = $request->instructor;
        $course->learning_style = $request->learning_style;
        $course->status = $request->status;
        $course->save();
        return redirect("/course_information/{$request->course_id}")->with('status', 'Course Updated!');
    }
    public static function getCourses() {
        return Course::query()
            ->leftJoin('categories', 'courses.category_1', '=', 'categories.id')
            ->leftJoin('departments', 'courses.department', '=', 'departments.id')
            ->leftJoin('users', 'courses.instructor', '=', 'users.id')
            ->leftJoin('learning_styles', 'courses.learning_style', '=', 'learning_styles.id')
            ->select('courses.id', 'courses.name', 'courses.excerpt', 'courses.status', 'departments.name as department_name', 'users.last_name as instructor_name', 'learning_styles.name as ls_name', 'courses.updated_at')->get()->toArray();
    }
    public static function getCoursesUpdateAdmin($id) {
        return Course::query()
            ->leftJoin('categories', 'courses.category_1', '=', 'categories.id')
            ->leftJoin('departments', 'courses.department', '=', 'departments.id')
            ->leftJoin('users', 'courses.instructor', '=', 'users.id')
            ->leftJoin('learning_styles', 'courses.learning_style', '=', 'learning_styles.id')
            ->select('courses.id', 'courses.name', 'courses.excerpt', 'courses.description' , 'courses.status', 'courses.learning_style', 'courses.department', 'departments.name as department_name', 'courses.instructor', 'users.first_name as instructor_fname', 'users.last_name as instructor_lname', 'learning_styles.name as ls_name', 'courses.category_1', 'categories.name as category_name', 'courses.updated_at')
            ->where('courses.id', '=', $id)->first();
    }
    public static function showCourses() {
        return view('sessions.admin.courses', [
            'courses' => Course::all(),
            'learning_styles' => Learning_Styles::all(),
            'departments' => Department::all(),
            'categorys' => Category::all(),
            'instructors' => User::all()
        ]);
    }
    public static function courseInformationRead($id) {
        return view('sessions.admin.course_information_readonly', [
            'course' => self::getCoursesUpdateAdmin($id),
            'learning_styles' => Learning_Styles::all(),
            'departments' => Department::all(),
            'categorys' => Category::all(),
            'instructors' => User::all(),
            'modules' => Module::where('course', '=', $id)->get(),
            'filepath' => "thumbnails/".Course::find($id)->name.'/'.Course::find($id)->name.'.jpg',
            'avg_grade' => GradebookController::getAverageCourseGrade($id),
            'last_graded' => GradebookController::getLastCourseGrade($id)
        ]);
    }
    public static function courseInformation($id) {
        return view('sessions.admin.course_information', [
            'course' => self::getCoursesUpdateAdmin($id),
            'learning_styles' => Learning_Styles::all(),
            'departments' => Department::all(),
            'categorys' => Category::all(),
            'instructors' => User::all(),
            'modules' => Module::where('course', '=', $id)->get(),
            'filepath' => "thumbnails/".Course::find($id)->name.'/'.Course::find($id)->name.'.jpg',
            'avg_grade' => GradebookController::getAverageCourseGrade($id),
            'last_graded' => GradebookController::getLastCourseGrade($id)
        ]);
    }
}
