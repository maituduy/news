<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function __construct() {
        $this->middleware('guest')->except(['logout']);
    }

    public function showLoginForm()
    {
        return view('client.login');
    }

    public function login(Request $request) 
    {
        $this->validateLogin($request);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            return redirect()->intended(route('home'));
        return redirect()->back()->withInput();
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
