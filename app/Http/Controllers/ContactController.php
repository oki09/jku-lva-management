<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submitFeedback()
    {
        $feedback = request()->validate([
            'email' => 'required|email',
            'message' => 'required',
            'name' => 'required'
        ]);

        $to = env('MAIL_TO_ADDRESS');
        $subject = 'Feedback from ' . $feedback['email'];
        $msg = wordwrap($feedback['message'], 70);
        $headers = 'From: ' . $feedback['name'] . ' <' . $feedback['email'] . '>';
        if(mail($to, $subject, $msg, $headers))
            return redirect()->route('info.contact')->with('isSent', true);
        else
            return redirect()->route('info.contact')->with('isSent', false);
    }
}
