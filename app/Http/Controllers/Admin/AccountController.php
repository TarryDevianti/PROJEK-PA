<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ukm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Menampilkan halaman utama manajemen akun dengan filter tab UKM.
     * Hanya Super Admin yang bisa mengakses.
     */
    public function index(Request $request)
    {
        // Pastikan hanya Super Admin yang bisa akses
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Akses ditolak. Hanya Super Admin.');
        }

        $activeUkm = $request->get('ukm', null);
        $showAll = $request->has('all');
        
        $ukms = Ukm::where('status', 'aktif')->orderBy('nama_ukm')->get();
        
        // Jika tidak ada filter dan tidak ada 'all', ambil UKM pertama
        if (!$activeUkm && $ukms->isNotEmpty() && !$showAll) {
            $activeUkm = $ukms->first()->nama_ukm;
        }

        $query = User::query();

        // Filter berdasarkan UKM
        if ($activeUkm && !$showAll) {
            $ukm = Ukm::where('nama_ukm', $activeUkm)->first();
            if ($ukm) {
                $query->where('ukm_id', $ukm->id);
            }
        }
        // Jika 'all', tidak ada filter UKM, tampilkan semua

        // Jika ada search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('npm', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Urutkan berdasarkan created_at
        $users = $query->latest()->paginate(10);
        
        return view('admin.pages.manajemen_akun.index', compact('users', 'activeUkm', 'ukms'));
    }

    /**
     * Menampilkan form tambah akun
     */
    public function create()
    {
        // Pastikan hanya Super Admin
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Akses ditolak.');
        }

        $ukms = Ukm::where('status', 'aktif')->get();
        return view('admin.pages.manajemen_akun.create', compact('ukms'));
    }

    /**
     * Memproses penyimpanan data akun admin baru.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'name'     => 'required|string|max:255',
            'npm'      => 'required|numeric|unique:users,npm',
            'password' => 'required|min:6', 
            'ukm_id'   => 'required|exists:ukms,id',
        ]);

        // Tentukan role secara otomatis berdasarkan ukm_id yang dipilih
        $ukm = Ukm::find($request->ukm_id);
        $role = 'admin_' . strtolower(str_replace(' ', '_', $ukm->nama_ukm));

        // Mapping khusus untuk UKM yang sudah ada
        $roleMapping = [
            'seuramoe' => 'admin_seramoe',
            'ulul_albab' => 'admin_ulul_albab',
            'ldf_ulul_albab' => 'admin_ulul_albab',
            'barracuda' => 'admin_barracuda'
        ];

        $slugLower = strtolower($ukm->slug);
        foreach ($roleMapping as $key => $value) {
            if (strpos($slugLower, $key) !== false) {
                $role = $value;
                break;
            }
        }

        $user = User::create([
            'name'           => $request->name,
            'npm'            => $request->npm,
            'email'          => $request->npm . '@mhs.usk.ac.id',
            'password'       => Hash::make($request->password), 
            'password_plain' => $request->password,
            'role'           => $role, 
            'ukm_id'         => $request->ukm_id,
            'is_active'      => true,
            'program_studi'  => $request->program_studi ?? '',
            'angkatan'       => $request->angkatan ?? '',
            'telepon'        => $request->telepon ?? '',
            'status_diterima' => 'diterima'
        ]);

        return redirect()->route('manajemen-akun.index', ['ukm' => $ukm->nama_ukm])
                         ->with('success', 'Akun admin berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit akun
     */
    public function edit($id)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Akses ditolak.');
        }

        $user = User::findOrFail($id); 
        $ukms = Ukm::where('status', 'aktif')->get(); 
        return view('admin.pages.manajemen_akun.edit', compact('user', 'ukms'));
    }

    /**
     * Memproses update/perubahan data akun.
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Akses ditolak.');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'npm'    => 'required|numeric|unique:users,npm,' . $id, 
            'ukm_id' => 'required|exists:ukms,id',
        ]);

        $ukm = Ukm::find($request->ukm_id);
        $role = 'admin_' . strtolower(str_replace(' ', '_', $ukm->nama_ukm));

        $roleMapping = [
            'seuramoe' => 'admin_seramoe',
            'ulul_albab' => 'admin_ulul_albab',
            'ldf_ulul_albab' => 'admin_ulul_albab',
            'barracuda' => 'admin_barracuda'
        ];

        $slugLower = strtolower($ukm->slug);
        foreach ($roleMapping as $key => $value) {
            if (strpos($slugLower, $key) !== false) {
                $role = $value;
                break;
            }
        }

        $data = [
            'name'   => $request->name,
            'npm'    => $request->npm,
            'role'   => $role,
            'ukm_id' => $request->ukm_id,
            'email'  => $request->npm . '@mhs.usk.ac.id',
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
            $data['password_plain'] = $request->password;
        }

        $user->update($data);

        return redirect()->route('manajemen-akun.index', ['ukm' => $ukm->nama_ukm])
                         ->with('success', 'Data akun ' . $user->name . ' berhasil diperbarui!');
    }

    /**
     * Mengubah status aktif/blokir akun pengguna.
     */
    public function blokir($id)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Akses ditolak.');
        }

        $akun = User::findOrFail($id);
        
        if ($akun->is_active) {
            $akun->is_active = false;
            $pesan = 'Akun berhasil diblokir!';
        } else {
            $akun->is_active = true;
            $pesan = 'Akun berhasil dibuka blokirnya!';
        }
        
        $akun->save();

        $ukm = Ukm::find($akun->ukm_id);
        $ukmParam = $ukm ? $ukm->nama_ukm : 'Seuramoe';

        return redirect()->route('manajemen-akun.index', ['ukm' => $ukmParam])->with('success', $pesan);
    }

    /**
     * Mereset password akun
     */
    public function resetPassword($id)
    {
        if (Auth::user()->role !== 'super_admin') {
            abort(403, 'Akses ditolak.');
        }

        $akun = User::findOrFail($id);
        
        $newPassword = 'password123';
        $akun->password = Hash::make($newPassword);
        $akun->password_plain = $newPassword; // <-- update plain
        $akun->save();

        $ukm = Ukm::find($akun->ukm_id);
        $ukmParam = $ukm ? $ukm->nama_ukm : 'Seuramoe';

        return redirect()->route('manajemen-akun.index', ['ukm' => $ukmParam])
                         ->with('success', 'Password berhasil di-reset menjadi ' . $newPassword . '!');
    }
}