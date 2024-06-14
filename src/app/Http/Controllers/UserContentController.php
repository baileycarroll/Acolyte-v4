<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\User_Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return redirect('/catalog');
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
}
