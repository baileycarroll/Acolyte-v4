<?php

namespace App\Http\Controllers;

use App\Models\Award;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AwardController extends Controller
{
    public function createAward(Request $request) {
        $extension = $request->file('award-upload-file')->extension();
        $filename = $request->name.'.'.$extension;
        Storage::putFileAs("awards", $request->file('award-upload-file'), $filename, 'public');
        $award = new Award();
        $award->name = $request->name;
        $award->description = $request->description;
        $award->filename = $filename;
        $award->save();
        return redirect('/awards')->with('status', 'Award Created!');
    }
    public function updateAward(Request $request) {
        if ($request->file() != NULL) {
            $extension = $request->file('file')->extension();
            $filename = $request->name.'.'.$extension;

            $award = Award::findorfail($request->award_id);
            $award->name = $request->name;
            $award->description = $request->description;
            $award->filename = $filename;

            $award->save();
            Storage::putFileAs("awards", $request->file('file'), $filename, 'public');
            return redirect("/award_information/{$request->award_id}")->with('status', 'Award Updated!');
        }
        $award = Award::findorfail($request->award_id);
        $award->name = $request->name;
        $award->description = $request->description;

        $award->save();
        return redirect("/award_information/{$request->award_id}")->with('status', 'Award Updated!');
    }
}
