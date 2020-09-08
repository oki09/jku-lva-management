<?php

namespace App\Http\Controllers;

use App\Course;
use App\Faq;
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

    public function show(User $user)
    {
        $courses = $user->courses;
        $studentId = $user->studentId;
        return view('admin.users.show', compact('courses', 'studentId'));
    }

    public function deleteCourse(User $user)
    {
        $user->courses()->destroy(request('course'));
        return redirect(route('admin.user.show', ['user' => $user->studentId]));
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
        return redirect(route('admin.news.index'));
    }

    public function newsDestroy($news)
    {
        News::destroy($news);
        return redirect(route('admin.news.index'));
    }

    public function newsShow($news)
    {
        $news = News::find($news);
        return view('admin.news.edit', compact('news'));
    }

    public function faqIndex()
    {
        $faqs = Faq::all();
        return view('admin.faq.index', compact('faqs'));
    }

    public function faqStore()
    {
        $id = request('id');
        if (isset($id)) {
            $faq = Faq::find($id);
            $faq->question_de = request('question_de');
            $faq->question_en = request('question_en');
            $faq->answer_en = request('answer_en');
            $faq->answer_de = request('answer_de');
            $faq->save();
        } else {
            Faq::create([
                'question_en' => request('question_en'),
                'answer_en' => request('answer_en'),
                'question_de' => request('question_de'),
                'answer_de' => request('answer_de')
            ])->save();
        }
        return redirect(route('admin.faq.index'));
    }

    public function faqShow($faq)
    {
        $faq = Faq::find($faq);
        return view('admin.faq.edit', compact('faq'));
    }

    public function faqDestroy($faq)
    {
        Faq::destroy($faq);
        return redirect(route('admin.faq.index'));
    }
}
