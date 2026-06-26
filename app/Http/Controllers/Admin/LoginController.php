<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Ukm;

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
                    return redirect()->route('dashboard.super.admin');

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
        'npm'      => 'required|string',
        'password' => 'required|string'
    ]);

    // Cari user berdasarkan NPM
    $user = User::where('npm', $request->npm)->first();

    if ($user) {
        // Cek apakah user aktif
        if (!$user->is_active) {
            return back()->withErrors(['npm' => 'Akun Anda telah dinonaktifkan.']);
        }

        // Validasi khusus untuk anggota (harus kode fakultas 08)
        if ($user->role === 'anggota') {
            $npm = $request->npm;
            if (strlen($npm) >= 4) {
                $kodeFakultas = substr($npm, 2, 2);
                if ($kodeFakultas !== '08') {
                    return back()->withErrors(['npm' => 'Maaf, hanya mahasiswa FMIPA (kode 08).']);
                }
            }
        }

        // Jika status_diterima belum 'diterima', tolak login
        if ($user->role === 'anggota' && $user->status_diterima !== 'diterima') {
            return back()->withErrors(['npm' => 'Akun Anda belum diverifikasi oleh UKM.']);
        }
    }

    // Attempt login
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->role === 'anggota') {
            // Jika user tidak punya UKM, arahkan ke pilih UKM
            if (!$user->ukm_id) {
                return redirect()->route('pilih.ukm')
                    ->with('info', 'Silakan pilih UKM terlebih dahulu.');
            }
            return redirect()->route('dashboard');
        }

        if ($user->role === 'super_admin') {
            return redirect()->route('dashboard.super.admin');
        }

        if (in_array($user->role, ['admin_seramoe', 'admin_ulul_albab', 'admin_barracuda'])) {
            return redirect()->route('admin-pengurus.dashboard');
        }

        return redirect('/');
    }

    return back()->withErrors(['npm' => 'NPM atau Password salah.']);
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
    public function showRegisterForm(Request $request)
    {
        $ukmSlug = $request->query('ukm_slug');
        $ukm = null;
        if ($ukmSlug) {
            $ukm = Ukm::where('slug', $ukmSlug)->first();
        }
        return view('Auth.register', compact('ukm'));
    }

    // ==========================================
    // PROSES REGISTER
    // ==========================================
    public function register(Request $request)
    {
        // Validasi NPM khusus mahasiswa FMIPA (kode 08)
        $npm = $request->npm;
        if (strlen($npm) >= 4) {
            $kodeFakultas = substr($npm, 2, 2);
            if ($kodeFakultas !== '08') {
                return back()
                    ->withInput()
                    ->withErrors(['npm' => 'Maaf, pendaftaran hanya untuk mahasiswa FMIPA (kode fakultas 08).']);
            }
        } else {
            return back()
                ->withInput()
                ->withErrors(['npm' => 'Format NPM tidak valid (minimal 4 digit).']);
        }

        // Validasi data form
        $request->validate([
            'name'          => 'required|string|max:255',
            'npm'           => 'required|string|max:50|unique:users,npm',
            'program_studi' => 'required|string',
            'angkatan'      => 'required|string|max:4',
            'email'         => 'required|email|max:255|unique:users,email',
            'telepon'       => 'required|string|max:20',
            'password'      => 'required|string|min:6',
        ]);

        // Simpan user baru
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
            'password_plain'  => $request->password, // <-- PASTIKAN INI ADA
        ]);

        // Login otomatis setelah register
        Auth::login($user);

        // Jika ada ukm_slug, langsung ke formulir pendaftaran UKM tersebut
        $ukmSlug = $request->input('ukm_slug');
        if ($ukmSlug) {
            $ukm = Ukm::where('slug', $ukmSlug)->first();
            if ($ukm) {
                return redirect()->route('mahasiswa.pendaftaran.isi', ['ukm_slug' => $ukmSlug])
                    ->with('success', 'Akun berhasil dibuat. Silakan lengkapi formulir pendaftaran UKM ' . $ukm->nama_ukm . '.');
            }
        }

        // Jika tidak ada slug, redirect ke pilih UKM
        return redirect()->route('pilih.ukm')
            ->with('success', 'Akun berhasil dibuat. Silakan pilih UKM dan isi formulir pendaftaran.');
    }
}