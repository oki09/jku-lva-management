<?php

namespace App\Http\Controllers;

use App\Course;
use App\Helpers\Util;
use App\Helpers\WkoMiddlewareHelper;
use App\User;
use GuzzleHttp\Exception\InvalidArgumentException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use function GuzzleHttp\json_encode;

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
        $lvas = User::find(Auth::id())->courses;
        return view('user.lva.index', compact('lvas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     * @throws InvalidArgumentException
     */
    public function create()
    {
        if (request()->ajax()) {
            $lvaData = [
                'lvaNr' => request('lvaNr'),
                'lvaName' => request('lvaName'),
                'lvaEcts' => request('lvaEcts'),
                'lvaSlotsUrl' => request('lvaSlotsUrl')
            ];
            return !$this->lvaExists($lvaData['lvaNr']) ? view('user.lva.ajaxData', compact('lvaData')) : '<p class="alert-danger">Kurs bereits hinzugefügt</p>';
        }
        return view('user.lva.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $user = User::find(Auth::id());
        $data = request()->json()->all();
        $lva = $user->courses()->create([
            'nr' => $data['nr'],
            'title' => $data['title'],
            'ects' => $data['ects']
        ]);
        foreach ($data['slots'] as $slot) {
            $lva->slots()->create([
                'start' => $slot['start'],
                'end' => $slot['end']
            ])->save();
        }
        $lva->save();
        // update total ects session
        session()->put('totalEcts', Util::getTotalEcts(Auth::id()));
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
        // update total ects session
        session()->put('totalEcts', Util::getTotalEcts(Auth::id()));
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
        $lva->isDisabled = request('disabling');
        $lva->save();
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
}
