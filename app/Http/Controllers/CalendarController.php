<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('layouts:user');
    }

    public function getEvents()
    {
        $events = [];
        $lvas = User::find(Auth::id())->courses;
        $cnt = 0;
        foreach ($lvas as $lva) {
            if ($lva->isDisabled == 'true') {
                foreach ($lva->slots as $slot) {
                    array_push($events, [
                        'id' => $cnt++,
                        'start' => $slot->start,
                        'end' => $slot->end,
                        'title' => $lva->title
                    ]);
                }
            }
        }
        return $events;
    }
}
