<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $validatior = Validator::make(
            $request->only('email', 'password'),
            $request->rules(),
            $request->messages()
        );

        if ($validatior->fails()) {
            return redirect()->back()->withErrors($request->all());
        }

        $rememberMe = $request->has('remember_me') ? true : false;
        $authenticate = auth()->guard('admin')->attempt(
            $request->only('email', 'password'),
            $rememberMe
        );
        if ($authenticate) {
            return redirect()->route('dashboard');
        }
        session()->flash('error', 'username or password is invalid');
        return redirect()->back();
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect()->route('showLogin');
    }
}
