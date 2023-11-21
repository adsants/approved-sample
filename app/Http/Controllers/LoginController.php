<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credential = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credential)) {
            if(Auth::user()->role == 'admin'){
                return redirect()->route('approved-peserta');
            }
            else{
                return redirect()->route('form-peserta');
            }
        }
        
        return back()->with(['error' => 'Login gagal, periksa email dan password Anda.'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}