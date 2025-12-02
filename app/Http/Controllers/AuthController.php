<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use GrahamCampbell\ResultType\Success;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);
        return redirect()->route('login')->with('Success', 'Registered Succesfully!');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (auth()->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('shop.index');
            }
        }

        return back()->withErrors('email', 'Invalid Email or Password');

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
