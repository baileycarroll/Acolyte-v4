<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\User;
use App\Models\User_Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AwardController extends Controller
{
    public function createAward(Request $request) {
        // Take uploaded file, if a proper file type proceed to upload to storage. Then Create the Award.
        $filename = $request->name.'.'. $request->file('award-upload-file')->extension();
        Storage::putFileAs("awards", $request->file('award-upload-file'), $filename, 'public');
        $award = new Award();
        $award->name = $request->name;
        $award->description = $request->description;
        $award->filename = $filename;
        $award->save();
        return redirect('/awards')->with('status', 'Award Created!');
    }
    public function updateAward(Request $request) {
        // If the request contains a file, then utilize the file uploads method and return.
        if ($request->file()) {
            $extension = $request->file('file')->extension();
            $filename = $request->name . '.' . $extension;

            $award = Award::findorfail($request->award_id);
            $award->name = $request->name;
            $award->description = $request->description;
            $award->filename = $filename;
            $award->save();
            Storage::putFileAs("awards", $request->file('file'), $filename, 'public');
            return redirect("/award_information/{$request->award_id}")->with('status', 'Award Updated!');
        }
        // Update award without new file
        $award = Award::findorfail($request->award_id);
        $award->name = $request->name;
        $award->description = $request->description;
        $award->save();
        return redirect("/award_information/{$request->award_id}")->with('status', 'Award Updated!');
    }
    public function addAwardToUser(Request $request) {
        if(User_Award::where('user', '=', $request->user)->where('award', '=', $request->award)->get()->isNotEmpty()) {
            return redirect("/award_information/$request->award")->with('error', 'User Already Has Award...');
        }
        $user_award = new User_Award();
        $user_award->user = $request->user;
        $user_award->award = $request->award;
        $user_award->save();
        return redirect("/award_information/$request->award")->with('status', 'User Given Award');
    }
    public function giveAwardToUser(Request $request) {
        if(User_Award::where('user', '=', $request->user)->where('award', '=', $request->award)->get()->isNotEmpty()) {
            return redirect("/user_information/$request->user")->with('error', 'User Already Has Award...');
        }
        $user_award = new User_Award();
        $user_award->user = $request->user;
        $user_award->award = $request->award;
        $user_award->save();
        return redirect("/user_information/$request->user")->with('status', 'User Given Award');
    }
    public static function showAwards() {
        return view('sessions.admin.awards', ['awards' => Award::all()]);
    }
    public static function awardInformationRead($id) {
        $file = Award::find($id)->filename;
        return view('sessions.admin.award_information_readonly', [
            'award' => Award::find($id),
            'image' => Storage::temporaryUrl("awards/$file.png", now()->addMinutes(10)),
        ]);
    }
    public static function awardInformation($id) {
        $file = Award::find($id)->filename;
        return view('sessions.admin.award_information', [
            'award' => Award::find($id),
            'users' => User::all()->users,
            'image' => Storage::temporaryUrl("awards/$file.png", now()->addMinutes(10)),
        ]);
    }
}
