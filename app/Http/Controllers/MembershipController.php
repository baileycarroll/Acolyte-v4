<?php

namespace App\Http\Controllers;

use App\Models\Licenses;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public static function createPaymentMethod() {
        return User::find(Auth::id())->createSetupIntent();
    }

    public static function showMemberships() {
        return view('membership', [
            'licenses' => Licenses::where('trial', '=', 0)->where('admin', '=', 0)->get(),
            'intent' => self::createPaymentMethod(),
            'user' => User::find(Auth::id()),
        ]);
    }
    public static function subscribeUser(Request $request) {
        User::find(Auth::id())->addPaymentMethod($request->paymentMethod);
        User::find(Auth::id())->newSubscription('acolyte', $request->stripe_product_api_id)->trialDays(15)->create($request->paymentMethod);
        return redirect('/home');
    }

    public static function billingPortal(Request $request) {
        return $request->user()->redirectToBillingPortal(route('my_profile'));
    }
}
