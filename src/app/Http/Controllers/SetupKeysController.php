<?php

namespace App\Http\Controllers;

use App\Models\SetupKeys;
use Illuminate\Http\Request;

class SetupKeysController extends Controller
{
    public function addSetupKey(Request $request) {
        $setup_key = new SetupKeys();
        $setup_key->key = $request->key_name;
        $setup_key->value = $request->key_value;
        $setup_key->old_value = $request->key_value;
        $setup_key->save();
        return redirect('/setup_keys')->with('status', 'Setup Key Created!');
    }
    public function updateSetupKey(Request $request) {
        $setup_key = SetupKeys::findOrFail($request->key_id);
        $setup_key->key = $request->key_name;
        $setup_key->old_value = $setup_key->value;
        $setup_key->value = $request->key_value;
        $setup_key->save();
        return redirect('/setup_keys')->with('status', 'Setup Key Updated!');
    }

    public function updateColorStyle() {
        $color_style = SetupKeys::where("key", "=", "Primary Color")->first()->value;
        $file_location = '../resources/sass/mdb_pro/custom/_variables.scss';
        $file_contents = "\$primary: $color_style; \$secondary: #bf0436;  \$accent: #f2055c;  \$text: #260101;  \$shadow: #400101;  \$white: #fff;  \$black: #000; \$datepicker-toggle-focus-color: \$primary; \$datepicker-header-background-color: \$primary;\$datepicker-cell-selected-background-color: \$primary;\$datepicker-cell-focused-selected-background-color: \$primary;\$datepicker-footer-btn-color: \$primary;\$form-outline-select-clear-btn-focus-color: \$primary;\$form-outline-select-label-color: \$primary;\$form-outline-select-notch-border-color: \$primary;\$form-outline-select-input-focused-arrow-color: \$primary;";
        file_put_contents($file_location, $file_contents);
        exec("npm run prod");
        return redirect('/setup_keys');
    }

    public static function showSetupKeys() {
        return view('sessions.admin.setup_keys', ['keys' => SetupKeys::all()]);
    }
    public static function setupKeyInformation($id) {
        return view('sessions.admin.setup_key_information', ['key' => SetupKeys::find($id)]);
    }

    public function generateCustomLinkKeys() {
        $num_keys = SetupKeys::where('key', '=', "num_custom_links")->first()->value;
        $num_existing_links = (SetupKeys::where('key', 'like', "custom_link_%")->count()) + 1;
        for($i = $num_existing_links; $i <= $num_keys;  $i++) {
            $key = new SetupKeys;
            $key->key = "custom_link_$i";
            $key->value = "None";
            $key->save();
        }
        return redirect('/setup_keys')->with('status', 'Setup Keys Created! Now fill them in!');
    }
}
