<?php

namespace App\Http\Controllers;

use App\News;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use phpDocumentor\Reflection\Types\Compound;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        date_default_timezone_set('Europe/Vienna');
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('admin.index'));
    }

    public function changeSemesterStart()
    {
        $date = request('semesterStart');
        config(['app.semesterStart' => $date]);
        return redirect()->route('admin.index');
    }

    public function maintenance()
    {
        $mode = request('mode');
        Artisan::call($mode == 'activate' ? 'down' : 'up');
        return redirect()->route('admin.settings');
    }

    public function showSettings()
    {
        return view('admin.settings');
    }

    public function newsIndex()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    public function newsStore()
    {
        $id = request('id');
        if (isset($id)) {
            $news = News::find($id);
            $news->de = request('de');
            $news->en = request('en');
            $news->save();
        } else {
            News::create(['de' => request('de'), 'en' => request('en')])->save();
        }
        return redirect(route('admin.news'));
    }

    public function newsDestroy($news)
    {
        News::destroy($news);
        return redirect(route('admin.news'));
    }

    public function newsShow($news)
    {
        $news = News::find($news);
        return view('admin.news.edit', compact('news'));
    }
}
