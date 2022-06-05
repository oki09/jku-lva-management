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
        $cnt = 1;
        foreach ($lvas as $lva) {
            if (!$lva->isDisabled) {
                foreach ($lva->slots as $slot) {
                    $event = [
                        'start' => $slot->start,
                        'end' => $slot->end,
                        'title' => $lva->title,
                        'nr' => $lva->nr,
                        'color' => $lva->color
                    ];
                    // check if same lva with same time exists (exclude multiple identical slots)
                    if (!$this->inArray($slot->start, $slot->end, $lva->title, $events)) {
                        $event['id'] = $cnt++;
                        array_push($events, $event);
                    }
                }
            }
        }
        return $this->markOverlaps($events);
    }

    private function markOverlaps($events)
    {
        $newEvents = [];
        foreach ($events as $event) {
            foreach ($events as $event2Check) {
                if ($event['nr'] != $event2Check['nr']) {
                    if (($event2Check['start'] >= $event['start'] && $event2Check['start'] <= $event['end']) ||
                        ($event2Check['end'] >= $event['start'] && $event2Check['end'] <= $event['end']) ||
                        ($event2Check['start'] >= $event['start'] && $event2Check['end'] <= $event['end'])) {
                        $event['color'] = 'red';
                    }
                }
            }
            array_push($newEvents, $event);
        }
        return $newEvents;
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
