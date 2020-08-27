<?php

namespace App\Http\Controllers;

class PrivacyController extends Controller
{
    public function show()
    {
        if (request()->ajax()) {
            if (request('lang') == 'de') return view('main.privacyLang.de');
            elseif (request('lang') == 'en') return view('main.privacyLang.en');
            else return '<p class="alert-danger">ERROR</p>';
        }
        return view('main.privacy');
    }

}
