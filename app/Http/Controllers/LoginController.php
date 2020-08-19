<?php

namespace App\Http\Controllers;

use App\Helpers\Util;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function login()
    {
        $credentials = request()->validate([
            'studentId' => 'required|starts_with:k,K|size:9',
            'password' => 'required'
        ]);
        $studentId = $credentials['studentId'];
        $password = $credentials['password'];

        $user = User::find($studentId);

        /* if the user is not found in the database, check the credentials in KUSSS
        Only needed for authorization purposes
        if ($user === null) {
            $sessionID = KusssAuthenticationHelper::getSessionId();
            $response = KusssAuthenticationHelper::authenticate($sessionID, $studentId, $password);

            if ($response) {
                $user = User::create(['studentId' => $studentId, 'password' => Hash::make($password)])->save();
            } else {
                redirect()->back()->withInput()->with('error', __('Username - Password combination is wrong'));
            }
        }*/

        if ($user === null) {
            $user = User::create(['studentId' => $studentId, 'password' => Hash::make($password)]);
            $user->save();
        }

        // The user is already in the database
        if (Auth::attempt(['studentId' => $user->studentId, 'password' => $password])) {
            return redirect()->intended('/')->with('totalEcts', Util::getTotalEcts(Auth::id()));
        }
        return redirect()->back()->withInput()->with('error', __('Username - Password combination is wrong'));
    }

    public function logout()
    {
        session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
