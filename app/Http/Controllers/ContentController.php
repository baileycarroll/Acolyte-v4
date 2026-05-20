<?php

namespace App\Http\Controllers;
use App\Models\Classes;
use App\Models\Course;
use App\Models\RelatedContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
        Storage::putFileAs("/thumbnails/$request->course_name", $request->file('course_thumbnail'), $request->course_name.'.jpg');
        return redirect("/course_information/$request->course_id")->with('status', 'Thumbnail Updated!');
    }
    public function uploadClassThumbnail(Request $request){
        Storage::putFileAs("/thumbnails/classes/$request->class_name", $request->file('class_thumbnail'), $request->class_name.'.jpg');
        return redirect("/class_information/$request->class_id")->with('status', 'Thumbnail Updated!');
    }
    public static function verifyContentExists($filepath) {
        return Storage::exists($filepath) ? 1 : 0;
    }
    public static function setSpotlightClass(Request $request) {
        $spotlight = Classes::find($request->id);
        if($spotlight->status != 'Active'){
            return redirect("/class_information/$request->id")->with('status', 'Not an active class, unable to set as spotlight.');
        }
        Classes::where('spotlight', '=', 1)->update(['spotlight'=>0]);
        $spotlight->spotlight = 1;
        $spotlight->save();
        return redirect("/class_information/$request->id")->with('status', 'Set as Spotlight Class');
    }
    public static function setSpotlightCourse(Request $request) {
        $spotlight = Course::find($request->id);
        if($spotlight->status != 'Active'){
            return redirect("/course_information/$request->id")->with('status', 'Not an active course, unable to set as spotlight.');
        }
        Course::where('spotlight', '=', 1)->update(['spotlight'=>0]);
        $spotlight->spotlight = 1;
        $spotlight->save();
        return redirect("/course_information/$request->id")->with('status', 'Set as Spotlight Course');
    }

    public static function getRelatedContent($content_type, $content_id) {
        if($content_type = 'class') {

            return DB::table('related_contents')
            ->join('classes', 'related_contents.related_class', '=', 'classes.id')
            ->select('related_contents.*', 'classes.name', 'classes.excerpt')
            ->get();
        }
        if($content_type = 'module') {
            return RelatedContent::where('module_id', '=', $content_id)->get();
        }
    }

}
