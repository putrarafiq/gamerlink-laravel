<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // 🧩 Tampilkan halaman register
    public function showRegister()
    {
        // Jika sudah login, jangan bisa register lagi
        if (Session::has('user_id')) {
            return redirect('/')->with('info', 'Kamu sudah login.');
        }

        return view('auth.register');
    }

    // 🧩 Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5'
        ]);

        // Simpan user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Langsung login setelah register
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->name);

        return redirect('/')->with('success', 'Akun berhasil dibuat dan login otomatis!');
    }

    // 🧩 Tampilkan halaman login
    public function showLogin()
    {
        // Jika sudah login, arahkan ke beranda
        if (Session::has('user_id')) {
            return redirect('/')->with('info', 'Kamu sudah login.');
        }

        return view('auth.login');
    }

    // 🧩 Proses login
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/'); // arahkan ke daftar teman mabar
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}


    // 🧩 Proses logout
    public function logout()
    {
        Session::flush();
        return redirect('/login')->with('success', 'Berhasil logout!');
    }
}
