<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginRequest;

class AuthController extends Controller
{
    public function admin()
    {
        $title = __('auth.title');
        if(Auth::id() !== null){
            return redirect()->route('dashboard.index');
        }
        return view('auth.loginAdmin', compact('title'));
    }

    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard.index')->with('success', __('auth.success'));
        }

        return back()->with('error', __('auth.error'));
    }
}
