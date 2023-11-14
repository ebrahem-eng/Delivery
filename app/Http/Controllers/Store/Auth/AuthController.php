<?php

namespace App\Http\Controllers\Store\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Login\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function login_page()
    {
        return view('Store.Auth.login');
    }

    public function login_check(LoginRequest $request)
    {
        $check = $request->all();
        if (Auth::guard('store')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('store.dashboard');
        } else {
            return redirect()->route('store.login.page')->with('error_message', 'Check Email Or Password');
        }
    }

    public function logout()
    {
        Auth::guard('store')->logout();
        return redirect()->route('store.login.page');
    }

}
