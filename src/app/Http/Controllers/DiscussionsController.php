<?php

namespace App\Http\Controllers;

use App\Models\discussions;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    public function createDiscussion(Request $request) {
        if(discussions::count() == 12) {
            return redirect('/discussions')->with('status', 'Only 12 Discussions Allowed!');
        }
        $discussion = new discussions();
        $discussion->topic = $request->topic;
        $discussion->related_class_1 = $request->related_class_1;
        $discussion->related_module = $request->related_module;
        $discussion->information = $request->information;
        $discussion->month = $request->month;
        $discussion->save();
        return redirect('/discussions')->with('status', 'Discussion Created!');
    }
    public function updateDiscussion(Request $request) {
        $discussion = discussions::findorfail($request->id);
        $discussion->topic = $request->topic;
        $discussion->related_class_1 = $request->related_class_1;
        $discussion->related_module = $request->related_module;
        $discussion->information = $request->information;
        $discussion->month = $request->month;
        $discussion->save();
        return redirect("/discussions/$request->id")->with('status', 'Discussion Updated!');
    }
}
