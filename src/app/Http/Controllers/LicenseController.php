<?php

namespace App\Http\Controllers;
use App\Models\Licenses;
use Illuminate\Http\Request;
use PharIo\Manifest\License;

class LicenseController extends Controller
{
    public function addLicense(Request $request) {
        $license_trial = $request->license_trial == "on" ? 1 : 0;
        $license_admin = $request->license_admin == "on" ? 1 : 0;
        $license = new Licenses();
        $license->name = $request->license_name;
        $license->description = $request->license_description;
        $license->stripe_api_id = $request->stripe_api_id;
        $license->price = $request->license_price;
        $license->trial = $license_trial;
        $license->admin = $license_admin;
        $license->save();
        return redirect('/licenses')->with('status', 'License Created!');
    }
    public function updateLicense(Request $request) {
        $license_trial = $request->license_trial == "on" ? 1 : 0;
        $license_admin = $request->license_admin == "on" ? 1 : 0;
        $license = Licenses::findOrFail($request->license_id);
        $license->name = $request->license_name;
        $license->description = $request->license_description;
        $license->stripe_api_id = $request->stripe_api_id;
        $license->price = $request->license_price;
        $license->trial = $license_trial;
        $license->admin = $license_admin;
        $license->save();
        return redirect('/licenses')->with('status', 'License Updated!');
    }
    public function deleteLicense(Request $request){
        Licenses::findOrFail($request->license_id)->delete();
        return redirect('/licenses')->with('status', 'License Deleted!');

    }
    public static function showLicenses() {
        return view('sessions.admin.licenses', ['licenses' => Licenses::all()]);
    }
    public static function licenseInformation($id) {
        return view('sessions.admin.license_information', ['license' => Licenses::find($id)]);
    }
    public static function licenseInformationRead($id) {
        return view('sessions.admin.license_information_readonly', ['license' => Licenses::find($id)]);
    }
}
