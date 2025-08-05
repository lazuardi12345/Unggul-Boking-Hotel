<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
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

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek apakah user bisa login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek URL asal login
            $currentUrl = $request->path(); // contoh: 'customer/login', 'admin/login', etc.

            // Validasi role berdasarkan URL
            if (
                (str_starts_with($currentUrl, 'customer') && $user->role !== 'customer') ||
                (str_starts_with($currentUrl, 'admin') && $user->role !== 'admin') ||
                (str_starts_with($currentUrl, 'agent') && $user->role !== 'agent')
            ) {
                Auth::logout();
                abort(Response::HTTP_FORBIDDEN, 'Forbidden: Anda tidak memiliki akses dari URL ini.');
            }

            // Redirect sesuai role
            return match ($user->role) {
                'admin'    => redirect()->route('admin-dashboard'),
                'agent'    => redirect()->route('agent-dashboard'),
                'customer' => redirect()->route('index'),
                default    => redirect()->route('login')->with('error', 'Role tidak dikenali.')
            };
        }

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
