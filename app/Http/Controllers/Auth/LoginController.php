<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::check()) return redirect()->route('home');
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validate = $request->validate([
            'login' => ['required', 'string', 'max:255'],
            'password' => ['required']
        ]);

        if (Auth::attempt($validate)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors(['login' => __('auth.failed')]);
    }
}
