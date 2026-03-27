<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login.index');
    }

    public function show()
    {
        $role = auth()->user()->role;
        return view('login.show', compact('role'));
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => ['required'],
                'password' => ['required'],
            ]);

            $remember = $request->has('remember');

            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                if(auth()->user()->role == 'admin'){
                    return redirect()->intended('/admin');
                }else{
                    return redirect()->intended('/user');
                }
            }

            return back()->withErrors([
                'username' => 'Username Atau Password Salah'
            ])->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat login!')->withInput();
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/')->with('success', 'Anda telah berhasil logout!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal logout!');
        }
    }
}
