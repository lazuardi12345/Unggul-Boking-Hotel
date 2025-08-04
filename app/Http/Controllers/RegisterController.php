<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showCustomerForm()
    {
        return view('auth.Register');
    }

    public function showAgentForm()
    {
        return view('agents.agent_register');
    }

    public function showAdminForm()
    {
        return view('admin.admin_register');
    }

    public function registerCustomer(Request $request)
    {
        \Log::info('Masuk ke fungsi registerCustomer');
        // Sesuaikan agar nama field yang digunakan konsisten
        $request->merge([
        'password_confirmation' => $request->input('confirm_password')
        ]);

    try {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        \Log::info('Validasi LULUS');

        $user = User::create([
            'full_name'   => $request->full_name,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'role'        => 'customer',
        ]);

        \Log::info('User berhasil disimpan', ['user' => $user]);

        return redirect()->route('login')->with('success', 'Registrasi Customer berhasil! Silakan login.');
    } catch (\Exception $e) {
        \Log::error('Error saat menyimpan user', ['error' => $e->getMessage()]);
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    public function registerAgent(Request $request)
    {
        \Log::info('Masuk ke fungsi registerAgent');
        // Sesuaikan agar nama field yang digunakan konsisten
        $request->merge([
        'password_confirmation' => $request->input('confirm_password')
        ]);

    try {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'agency_name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        \Log::info('Validasi LULUS');

        $user = User::create([
            'full_name'   => $request->full_name,
            'email'       => $request->email,
            'agency_name' => $request->agency_name,
            'password'    => Hash::make($request->password),
            'role'        => 'agent',
        ]);

        \Log::info('User berhasil disimpan', ['user' => $user]);

        return redirect()->route('agent-login')->with('success', 'Registrasi Agent berhasil! Silakan login.');
    } catch (\Exception $e) {
        \Log::error('Error saat menyimpan user', ['error' => $e->getMessage()]);
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}


    public function registerAdmin(Request $request)
{
    \Log::info('Masuk ke fungsi registerAdmin');

    $request->merge([
        'password_confirmation' => $request->input('confirm_password')
    ]);

    \Log::info('Request after merge', $request->all());

    try {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'admin_role' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        \Log::info('Validasi LULUS');

        $user = User::create([
            'full_name'   => $request->full_name,
            'admin_role'  => $request->admin_role,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            'role'        => 'admin',
        ]);

        \Log::info('User berhasil disimpan', ['user' => $user]);

        return redirect()->route('admin-login')->with('success', 'Registrasi Admin berhasil! Silakan login.');
    } catch (\Exception $e) {
        \Log::error('Error saat menyimpan user', ['error' => $e->getMessage()]);
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
}