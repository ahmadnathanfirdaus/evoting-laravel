<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function index()
    {
        return Inertia::render('Login');
    }

    public function settings()
    {
        return Inertia::render('Settings');
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required'
        ]);

        if ($validated) {
            $oldPassword = $request->oldPassword;
            $newPassword = $request->newPassword;
            $confirmPassword = $request->confirmPassword;

            if ($newPassword === $confirmPassword) {
                $user = Auth::user();
                if (password_verify($oldPassword, $user->password)) {
                    $user->update(['password' => bcrypt($newPassword)]);
                    return redirect('/settings')->with(['success' => 'Password berhasil diubah']);
                }
                return back()->withErrors(['invalidPassword' => 'Password lama salah']);
            }
            return back()->withErrors(['invalidPassword' => 'Password baru tidak sama']);
        }
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validated) {
            $credentials = $request->only('username', 'password');
            if (Auth::attempt($credentials)) {
                $request->session()->put('login', true);
                return redirect('/dashboard');
            }
            return back()->withErrors(['invalidLogin' => 'Username atau password salah']);
        }

        return back()->withErrors(['invalidLogin' => 'Username atau password tidak boleh kosong']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('login');
        Auth::logout();
        return redirect('/login');
    }
}
