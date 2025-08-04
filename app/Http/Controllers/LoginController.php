<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // public function showCustomerLoginForm()
    // {
    //     return view('auth.login');
    // }
    public function showAgentLoginForm()
    {
        return view('agents.agent_login');
    }
    public function showAdminLoginForm()
    {
        return view('admin.admin_login');
    }
    public function showCustomerLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
    $credentials = $request->validate([
        'email'    => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // Redirect sesuai role
        if ($user->role === 'admin') {
            return redirect()->route('admin-dashboard');
        } elseif ($user->role === 'agent') {
            return redirect()->route('agent-dashboard');
        } elseif ($user->role === 'customer') {
            return redirect()->route('index');
        } else {
            // Jika role tidak dikenali
            Auth::logout();
            return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    // Email atau password salah
    return back()->with('error', 'Email atau password salah.')->withInput();
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user-selection');
    }
}
