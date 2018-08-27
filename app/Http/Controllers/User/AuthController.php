<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    protected $redirectTo = '/';

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

    public function showSignupForm() {
        return view('client.signup');
    }

    public function signup(Request $request) {
        $validator = Validator::make($request->all() ,[
            'email' => 'required|unique:users|max:255',
            'name' => 'required|max:255',
            'password' => 'required|min:6|max:25|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::create($request->except('password_confirmation'));
        Auth::login($user);
        return redirect()->route('home');
    }
}
