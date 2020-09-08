<?php

namespace App\Http\Controllers;

use App\Helpers\KusssAuthenticationHelper;
use App\Helpers\Util;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:user')->except('logout');
    }

    /**
     * Handle an authentication attempt.
     *
     */
    public function userLogin()
    {
        $credentials = request()->validate([
            'studentId' => 'required|starts_with:k,K',
            'password' => 'required'
        ]);
        $studentId = strtolower($credentials['studentId']);
        $password = $credentials['password'];

        $user = User::find($studentId);

        /* If the user is not found in the database, check the credentials in KUSSS
        Only needed for authorization purposes */
        if (!isset($user)) {
            $cookie = KusssAuthenticationHelper::getCookie();
            $response = KusssAuthenticationHelper::authenticate($cookie, $studentId, $password);
            if ($response) {
                $user = User::create(['studentId' => $studentId, 'password' => Hash::make($password)]);
                $user->save();
            } else {
                return redirect()->back()->withInput()->with('error', __('Invalid student id or password!'));
            }
        }

        // The user is already in the database
        if (Auth::guard('user')->attempt(['studentId' => $user->studentId, 'password' => $password])) {
            session()->put('totalEcts', Util::getTotalEcts(Auth::id()));
            return redirect()->route('calendar.index');
        }
        return redirect()->back()->withInput()->with('error', __('Invalid student id or password!'));
    }

    public function adminLogin()
    {
        $credentials = request()->validate([
            'adminId' => 'required',
            'password' => 'required'
        ]);
        $adminId = $credentials['adminId'];
        $password = $credentials['password'];

        if (Auth::guard('admin')->attempt(['adminId' => $adminId, 'password' => $password])) {
            return redirect()->route('admin.index');
        }
        return redirect()->back()->withInput()->with('error', __('Username - Password combination is wrong'));
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();
        return redirect()->route('home');
    }
}
