<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ukm; // Import model Ukm untuk mengambil daftar kelompok kerja
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Menampilkan halaman utama manajemen akun dengan filter tab UKM.
     */
    public function index(Request $request)
    {
        // Ambil parameter ukm dari URL tab, default ke 'Seuramoe' jika kosong
        $activeUkm = $request->get('ukm', 'Seuramoe');
        
        // Mapping string nama tab UI langsung ke ID UKM di database
        $ukmMapping = [
            'Seuramoe'   => 1,
            'Ulul Albab' => 2,
            'Barracuda'  => 3
        ];

        // Dapatkan ID UKM target, jika tidak cocok default ke ID 1 (Seuramoe)
        $targetUkmId = $ukmMapping[$activeUkm] ?? 1;

        // Filter: Ambil data user yang memiliki ukm_id sesuai dengan tab aktif
        $query = User::query()->where('ukm_id', $targetUkmId);
        
        // Fitur pencarian berdasarkan Nama atau NPM
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('npm', 'like', '%' . $request->search . '%');
            });
        }

        $users = $query->latest()->get();
        
        return view('admin.pages.manajemen_akun.index', compact('users', 'activeUkm'));
    }

    /**
     * Menampilkan form tambah akun (Dinamis mengambil semua data UKM).
     */
    public function create()
    {
        $ukms = Ukm::all(); 
        return view('admin.pages.manajemen_akun.create', compact('ukms'));
    }

    /**
     * Memproses penyimpanan data akun admin baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'npm'      => 'required|numeric|unique:users,npm',
            'password' => 'required|min:6', 
            'ukm_id'   => 'required|exists:ukms,id',
        ]);

        // Tentukan string role secara otomatis berdasarkan ukm_id yang dipilih
        $role = 'admin_seramoe';
        if ($request->ukm_id == 2) {
            $role = 'admin_ulul_albab';
        } elseif ($request->ukm_id == 3) {
            $role = 'admin_barracuda';
        }

        // Menyimpan data user baru (Baris password_plain dihapus total)
        $user = User::create([
            'name'           => $request->name,
            'npm'            => $request->npm,
            'email'          => $request->npm . '@mhs.usk.ac.id',
            'password'       => Hash::make($request->password), 
            'role'           => $role, 
            'ukm_id'         => $request->ukm_id,
            'is_active'      => true
        ]);

        // Redirect kembali ke tab kelompok UKM yang bersangkutan agar langsung muncul
        $ukmParam = 'Seuramoe';
        if ($user->ukm_id == 2) $ukmParam = 'Ulul Albab';
        if ($user->ukm_id == 3) $ukmParam = 'Barracuda';

        return redirect()->route('manajemen-akun.index', ['ukm' => $ukmParam])
                         ->with('success', 'Akun admin berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit akun beserta data UKM-nya.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); 
        $ukms = Ukm::all(); 
        return view('admin.pages.manajemen_akun.edit', compact('user', 'ukms'));
    }

    /**
     * Memproses update/perubahan data akun.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'npm'    => 'required|numeric|unique:users,npm,' . $id, 
            'ukm_id' => 'required|exists:ukms,id',
        ]);

        // Ubah role secara otomatis sesuai kelompok UKM baru yang dipilih
        $role = 'admin_seramoe';
        if ($request->ukm_id == 2) {
            $role = 'admin_ulul_albab';
        } elseif ($request->ukm_id == 3) {
            $role = 'admin_barracuda';
        }

        $data = [
            'name'   => $request->name,
            'npm'    => $request->npm,
            'role'   => $role,
            'ukm_id' => $request->ukm_id,
            'email'  => $request->npm . '@mhs.usk.ac.id', 
        ];

        // Jika form input password baru diisi saat edit data
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
            // Baris password_plain dihapus untuk menghindari SQL QueryException
        }

        $user->update($data);

        // Redirect dinamis ke tab asal kelompok ukm_id yang baru diubah
        $ukmParam = 'Seuramoe';
        if ($user->ukm_id == 2) $ukmParam = 'Ulul Albab';
        if ($user->ukm_id == 3) $ukmParam = 'Barracuda';

        return redirect()->route('manajemen-akun.index', ['ukm' => $ukmParam])
                         ->with('success', 'Data akun ' . $user->name . ' berhasil diperbarui!');
    }

    /**
     * Mengubah status aktif/blokir akun pengguna.
     */
    public function blokir($id)
    {
        $akun = User::findOrFail($id);
        
        if ($akun->is_active) {
            $akun->is_active = false;
            $pesan = 'Akun berhasil diblokir!';
        } else {
            $akun->is_active = true;
            $pesan = 'Akun berhasil dibuka blokirnya!';
        }
        
        $akun->save();

        // Redirect dinamis kembali ke tab asal kelompoknya
        $ukmParam = 'Seuramoe';
        if ($akun->ukm_id == 2) $ukmParam = 'Ulul Albab';
        if ($akun->ukm_id == 3) $ukmParam = 'Barracuda';

        return redirect()->route('manajemen-akun.index', ['ukm' => $ukmParam])->with('success', $pesan);
    }

    /**
     * Mereset password akun kembali ke default (password123).
     */
    public function resetPassword($id)
    {
        $akun = User::findOrFail($id);
        
        // Simpan versi enkripsi Bcrypt saja (Baris password_plain dihapus)
        $akun->password = Hash::make('password123');
        $akun->save();

        // Redirect dinamis kembali ke tab asal kelompoknya
        $ukmParam = 'Seuramoe';
        if ($akun->ukm_id == 2) $ukmParam = 'Ulul Albab';
        if ($akun->ukm_id == 3) $ukmParam = 'Barracuda';

        return redirect()->route('manajemen-akun.index', ['ukm' => $ukmParam])
                         ->with('success', 'Password berhasil di-reset menjadi password123!');
    }
}