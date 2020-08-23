<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('layouts:admin');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function destroy(User $user)
    {
        dd($user);
    }

    public function changeSemesterStart()
    {
        $date = request('semesterStart');
        config(['app.semesterStart' => $date]);
        return redirect()->route('admin.index');
    }
}
