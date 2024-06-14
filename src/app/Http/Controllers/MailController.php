<?php

namespace App\Http\Controllers;

use App\Mail\ContactUser;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\TestMail;
class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        Mail::to('hunter.fpatti@gmail.com')->send(new ContactUser());
        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        }else{
            return response()->success('Great! Successfully send in your mail');
        }
    }
    public function contactUser(Request $request) {
        $email = new Email();
        $email->to_address = $request->contact;
        $email->author = Auth::id();
        $email->subject = $request->subject;
        $email->body = $request->body;
        $email->save();
        if (Mail::to($request->contact)->send(new ContactUser($request))) {
            return redirect('/users')->with('status', 'Email Sent!');
        } else {
            return redirect('/users')->with('error', 'Email Failed! Please contact Support');
        }
    }
}
