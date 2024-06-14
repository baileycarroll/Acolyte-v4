<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Classes;
use App\Models\User_Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function uploadClassContent(Request $request){
        $extension = $request->file('class_content')->extension();
        $filename = $request->class_name.'.'.$extension;
        if ($request->file('class_content')->extension() != "mp4") {
            return redirect("/class_information/{$request->class_id}")->with('status', 'Wrong File Type, Content must be in MP4 format at this time.');
        }
        Storage::putFileAs("classes/{$request->class_name}", $request->file('class_content'), $filename);
        return redirect("/class_information/{$request->class_id}")->with('status', 'Content Uploaded Successfully');
    }
    public function uploadModuleContent(Request $request){
        $filename = $request->module_name.'.'.$request->file('module_content')->extension();
        if ($request->file('module_content')->extension() != "mp4"){
            return redirect("/module_information/$request->module_id")->with('status', 'Wrong File Type, Content must be in MP4 format at this time.');
        }
        Storage::putFileAs("/modules/$request->module_name", $request->file('module_content'), $filename);
        return redirect("/module_information/$request->module_id")->with('status', 'Content Uploaded Successfully');
    }
    public function uploadCourseThumbnail(Request $request){
        Storage::putFileAs("/thumbnails/$request->course_name", $request->file('course_thumbnail'), $request->course_name.'.'.$request->file('course_thumbnail')->extension());
        return redirect("/course_information/$request->course_id")->with('status', 'Thumbnail Updated!');
    }
    public function uploadClassThumbnail(Request $request){
        Storage::putFileAs("/thumbnails/classes/$request->class_name", $request->file('class_thumbnail'), $request->class_name.'.'.$request->file('class_thumbnail')->extension());
        return redirect("/class_information/$request->class_id")->with('status', 'Thumbnail Updated!');
    }
    public static function verifyContentExists($filepath) {
        if (Storage::exists($filepath)) {
            $file_exists = 1;
            return $file_exists;
        }
    }

}
