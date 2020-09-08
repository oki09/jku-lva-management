<?php

namespace App\Http\Controllers;

use App\Faq;
use App\News;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->get();
        return view('main.home', compact('news'));
    }

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
        $headers = [
            'From' => $feedback['name'] . ' <' . $feedback['email'] . '>',
            'X-Mailer' => 'PHP/' . phpversion(),
            'MIME-Version' => '1.0',
            'Content-type' => 'text/plain; charset=utf-8'
        ];
        if (mail($to, $subject, $msg, $headers, '-f' . $to))
            return redirect()->route('info.contact')->with('isSent', true);
        else
            return redirect()->route('info.contact')->with('isSent', false);
    }

    public function faqs()
    {
        $faqs = Faq::all();
        return view('main.faq', compact('faqs'));
    }

}
