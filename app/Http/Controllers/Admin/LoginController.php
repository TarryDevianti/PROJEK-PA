<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // ==========================================
    // HALAMAN LOGIN
    // ==========================================
    public function index()
    {
        if (Auth::check()) {

            $user = Auth::user();

            switch ($user->role) {

                case 'super_admin':
                    return redirect()->route('admin.dashboard');

                case 'admin_seramoe':
                case 'admin_ulul_albab':
                case 'admin_barracuda':
                    return redirect()->route('admin-pengurus.dashboard');

                default:
                    return redirect()->route('dashboard');
            }
        }

        return view('Auth.login');
    }

    // ==========================================
    // PROSES LOGIN
    // ==========================================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'npm'      => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            // ANGGOTA
            if ($user->role === 'anggota') {

                if ($user->status_diterima !== 'diterima') {

                    Auth::logout();

                    return back()->withErrors([
                        'npm' => 'Akun Anda belum diverifikasi oleh UKM.'
                    ]);
                }

                return redirect()->route('dashboard');
            }

            // SUPER ADMIN
            if ($user->role === 'super_admin') {
                return redirect()->route('admin.dashboard');
            }

            // ADMIN PENGURUS
            if (
                in_array($user->role, [
                    'admin_seramoe',
                    'admin_ulul_albab',
                    'admin_barracuda'
                ])
            ) {
                return redirect()->route('admin-pengurus.dashboard');
            }

            return redirect('/');
        }

        return back()->withErrors([
            'npm' => 'NPM atau Password salah.'
        ]);
    }

    // ==========================================
    // LOGOUT
    // ==========================================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // ==========================================
    // FORM REGISTER
    // ==========================================
    public function showRegisterForm()
    {
        return view('Auth.register');
    }

    // ==========================================
    // PROSES REGISTER
    // ==========================================
    public function register(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'npm'           => 'required|string|max:50|unique:users,npm',
            'program_studi' => 'required|string',
            'angkatan'      => 'required|string|max:4',
            'email'         => 'required|email|max:255|unique:users,email',
            'telepon'       => 'required|string|max:20',
            'password'      => 'required|string|min:6',
        ]);

        $user = User::create([
            'name'            => $request->name,
            'npm'             => $request->npm,
            'program_studi'   => $request->program_studi,
            'angkatan'        => $request->angkatan,
            'email'           => $request->email,
            'telepon'         => $request->telepon,
            'role'            => 'anggota',
            'status_diterima' => 'pending',
            'is_active'       => true,
            'password'        => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', 'Akun berhasil dibuat.');
    }
}
