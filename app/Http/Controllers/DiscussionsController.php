<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\discussions;
use App\Models\Module;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    public function createDiscussion(Request $request) {
        if(discussions::all()->count() == 12) return redirect('/discussions')->with('status', 'Only 12 Discussions Allowed!');
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
    public static function showDiscussions() {
        return view('sessions.admin.discussions', ['classes' => Classes::all(), 'modules' => Module::all()]);
    }
    public static function discussionInformationRead($id) {
        return view('sessions.admin.discussion_information_readonly', [
            'discussion' => Discussions::find($id),
            'classes' => Classes::all(),
            'modules' => Module::all()
        ]);
    }
    public static function discussionInformation($id) {
        return view('sessions.admin.discussion_information', [
            'discussion' => Discussions::find($id),
            'classes' => Classes::all(),
            'modules' => Module::all()
        ]);
    }
}
