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
        $this->middleware('auth:user');
    }

    public function getEvents()
    {
        $events = [];
        $lvas = User::find(Auth::id())->courses;
        $cnt = 0;
        foreach ($lvas as $lva) {
            if (!$lva->isDisabled) {
                foreach ($lva->slots as $slot) {
                    $event = [
                        'start' => $slot->start,
                        'end' => $slot->end,
                        'title' => $lva->title,
                        'nr' => $lva->nr
                    ];
                    // check if same lva with same time exists
                    if (!$this->inArray($slot->start, $slot->end, $lva->title, $events)) {
                        $event['id'] = $cnt++;
                        array_push($events, $event);
                    }
                }
            }
        }
        return $events;
    }

    /***
     * Compares an event with an array of events
     * @param $start
     * @param $end
     * @param $title
     * @param $arr
     * @return bool
     */
    private function inArray($start, $end, $title, $arr)
    {
        foreach ($arr as $element) {
            if ($element['title'] == $title && $element['start'] == $start && $element['end'] == $end) {
                return true;
            }
        }
        return false;
    }
}
