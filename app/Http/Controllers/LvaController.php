<?php

namespace App\Http\Controllers;

use App\User;
use App\Helpers\Util;
use App\Helpers\WkoMiddlewareHelper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LvaController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $courses = User::find(Auth::id())->courses;
        $lvas = $this->getWorkload($courses);
        return view('user.lva.index', compact('lvas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (request()->ajax()) {
            $lvaData = (object)[
                'lvaNr' => request('lvaNr'),
                'lvaName' => request('lvaName'),
                'lvaEcts' => request('lvaEcts'),
                'lvaSlotsUrl' => request('lvaSlotsUrl')
            ];
            return !$this->lvaExists($lvaData->lvaNr) ? view('user.lva.ajaxData', compact('lvaData')) : '<p class="alert-danger">Course already added</p>';
        }
        return view('user.lva.create');
    }

    /***
     * Simulates the KUSSS LVA search
     * @return Application|Factory|View
     */
    public function getLvaList()
    {
        $lvaData = request()->json()->all();
        $lvaList = new Collection();
        foreach ($lvaData as $lva) {
            $lva['isAdded'] = $this->lvaExists($lva['lvaNr']);
            /*if (!$this->lvaExists($lva['lvaNr'])) {
                $lvaList->push((object)$lva);
            }*/
            $lvaList->push((object)$lva);
        }
        return view('user.lva.ajaxData', compact('lvaList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store()
    {
        $user = User::find(Auth::id());
        $data = request()->json()->all();
        $lva = $user->courses()->create([
            'nr' => $data['nr'],
            'title' => $data['title'],
            'ects' => $data['ects'],
            'capacity' => $data['capacity'],
            'isDisabled' => false,
            'handbookUrl' => $data['handbookUrl']
        ]);
        foreach ($data['slots'] as $slot) {
            $lva->slots()->create([
                'start' => $slot['start'],
                'end' => $slot['end']
            ])->save();
        }
        $lva->save();
        $this->updateTotalEcts(Auth::id());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy()
    {
        $user = User::find(Auth::id());
        $lva = $user->courses()->where('nr', request('lva'))->first();
        $user->courses()->destroy($lva);
        $this->updateTotalEcts(Auth::id());
        return redirect(route('lva.index'));
    }

    /**
     * Work-around for blocking AJAX calls of JQuery to the KUSSS host.
     * https://scode7.blogspot.com/2019/11/how-to-fix-ajax-no-access-control-allow.html
     *
     * @return mixed
     */
    public function proxyRequests()
    {
        $url = request('url');
        $htmlString = file_get_contents($url);
        return html_entity_decode($htmlString);
    }

    /**
     * Disables the selected lva
     * @return mixed
     */
    public function disable()
    {
        $user = User::find(Auth::id());
        $lva = $user->courses()->where('nr', request('lvaNr'))->first();
        $lva->isDisabled = request('disabling') == 'false';
        $lva->save();
    }

    private function updateTotalEcts($id)
    {
        session()->put('totalEcts', Util::getTotalEcts($id));
    }

    /**
     * Checks if the LVA with the given number is already assigned to the student
     * @param $lvaNr
     * @return bool
     */
    private function lvaExists($lvaNr)
    {
        $user = User::find(Auth::id());
        $lva = $user->courses()->where('nr', $lvaNr)->first();
        return isset($lva);
    }

    private function getWorkload($courses)
    {
        $lvas = new Collection();
        foreach ($courses as $lva) {
            $otherUsers = User::where([
                ['courses.nr', '=', $lva->nr],
                ['studentId', '!=', Auth::id()]
            ])->get();
            $lva->workload = $otherUsers->count();
            $lvas->push($lva);
        }
        return $lvas;
    }
}
