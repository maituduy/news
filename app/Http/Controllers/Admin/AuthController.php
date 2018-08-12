<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('guest:admin')->except(['logout']);
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]))
            return redirect()->intended(route('admin_dashboard'));
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
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
