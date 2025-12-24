<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthLoginRequest;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthController extends Controller
{

    public function index() {
        return Inertia::render('Login');
    }

    public function login(Request $request) {

        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255']
        ]);

        if (Auth::attempt($validatedData, $request->boolean('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->user_type === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'username' => 'The provided credentials did not match to our records.'
        ])->onlyInput('username');
    }


    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
