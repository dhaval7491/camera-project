<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginPage()
    {
        return view('superadmin.auth.login');
    }

    public function login(LoginRequest $request)
    {

        if(Auth::attempt($request->only('email','password'))){
            return redirect()->route('superadmin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credential do match our records'
        ]);
    }
}
