<?php

namespace App\Http\Controllers;

use App\Models\Course;
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
}
