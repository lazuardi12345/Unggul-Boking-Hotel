<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    // Tampilkan form login untuk masing-masing role
    public function showCustomerLoginForm()
    {
        return view('auth.login');
    }

    public function showAgentLoginForm()
    {
        return view('agents.agent_login');
    }

    public function showAdminLoginForm()
    {
        return view('admin.admin_login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Ambil URL asal login (contoh: customer/login)
            $currentUrl = $request->path();

            // Cek kecocokan role dengan URL login
            if (
                (str_starts_with($currentUrl, 'customer') && $user->role !== 'customer') ||
                (str_starts_with($currentUrl, 'admin') && $user->role !== 'admin') ||
                (str_starts_with($currentUrl, 'agent') && $user->role !== 'agent')
            ) {
                Auth::logout();
                abort(Response::HTTP_FORBIDDEN, 'Forbidden: Anda tidak memiliki akses dari URL ini.');
            }

            // Arahkan sesuai role
            return match ($user->role) {
                'admin'    => redirect()->route('admin-dashboard'),
                'agent'    => redirect()->route('agent-dashboard'),
                'customer' => redirect()->route('index'),
                default    => redirect()->route('login')->with('error', 'Role tidak dikenali.')
            };
        }

        return back()->with('error', 'Email atau password salah.')->withInput();
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user-selection'); // halaman pemilihan login
    }
}
