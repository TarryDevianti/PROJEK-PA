@extends('admin.layouts.main')

@section('content')
<div class="container-fluid pt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-uppercase bg-secondary text-white px-4 py-2 rounded-3 mb-0 shadow-sm" style="font-size: 1.5rem;">
            Pusat Kendali Akun Pengguna
        </h3>
        <a href="{{ route('manajemen-akun.create') }}" class="btn btn-dark rounded-circle shadow d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
            <i class="bi bi-plus-lg fs-4"></i>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('manajemen-akun.index', ['ukm' => 'Seuramoe']) }}" 
           class="btn btn-sm {{ $activeUkm == 'Seuramoe' ? 'btn-secondary text-white fw-bold' : 'btn-outline-secondary' }} px-3 text-uppercase">
            Seuramoe
        </a>
        <a href="{{ route('manajemen-akun.index', ['ukm' => 'Ulul Albab']) }}" 
           class="btn btn-sm {{ $activeUkm == 'Ulul Albab' ? 'btn-secondary text-white fw-bold' : 'btn-outline-secondary' }} px-3 text-uppercase">
            LDF Ulul Albab
        </a>
        <a href="{{ route('manajemen-akun.index', ['ukm' => 'Barracuda']) }}" 
           class="btn btn-sm {{ $activeUkm == 'Barracuda' ? 'btn-secondary text-white fw-bold' : 'btn-outline-secondary' }} px-3 text-uppercase">
            Barracuda
        </a>
    </div>

    <div class="d-flex justify-content-end mb-3">
        <form action="{{ route('manajemen-akun.index') }}" method="GET" class="d-flex" style="max-width: 300px; width: 100%;">
            <input type="hidden" name="ukm" value="{{ $activeUkm }}">
            <div class="input-group input-group-sm border rounded-pill bg-white px-2 py-1 shadow-sm w-100">
                <input type="text" name="search" class="form-control border-0 bg-transparent" placeholder="Cari akun..." value="{{ request('search') }}">
                <button class="btn border-0 bg-transparent text-muted" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="table-light border-bottom text-secondary">
                        <tr>
                            <th width="5%" class="py-3">No</th>
                            <th class="text-start ps-4" width="25%">Nama</th>
                            <th width="15%">NPM</th>
                            <th width="15%">Role</th>
                            <th width="15%">Password</th>
                            <th width="25%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                        <tr class="{{ !$user->is_active ? 'table-danger opacity-75' : '' }}">
                            <td class="fw-bold text-secondary">{{ $index + 1 }}.</td>
                            <td class="text-start ps-4">
                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-3 py-2">
                                    {{ $user->npm ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark text-uppercase font-monospace px-3 py-2" style="font-size: 0.75rem;">
                                    {{ str_replace('_', ' ', $user->role) }}
                                </span>
                            </td>
                            <td>
                                <div class="input-group input-group-sm justify-content-center mx-auto shadow-sm border rounded" style="max-width: 150px; overflow: hidden;">
                                    <input type="password" 
                                           class="form-control text-center bg-white border-0 password-field font-monospace fw-bold" 
                                           value="{{ $user->password_plain ?? 'SandiLama' }}" 
                                           readonly 
                                           style="font-size: 0.85rem; letter-spacing: 1px;">
                                    <button class="btn btn-light border-start toggle-password-btn" type="button" title="Lihat Password">
                                        <i class="bi bi-eye-slash text-muted"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <form action="{{ route('manajemen-akun.reset', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mereset password akun {{ $user->name }}?')">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm fw-bold text-white px-2 shadow-sm btn-action">
                                            RESET
                                        </button>
                                    </form>

                                    <a href="{{ route('manajemen-akun.edit', $user->id) }}" 
                                       class="btn btn-sm btn-warning fw-bold text-dark px-2 shadow-sm d-flex align-items-center btn-action"
                                       style="background-color: #ffff00; border: none;">
                                        EDIT
                                    </a>

                                    <form action="{{ route('manajemen-akun.blokir', $user->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn {{ $user->is_active ? 'btn-danger' : 'btn-success' }} btn-sm fw-bold px-2 shadow-sm btn-action">
                                            {{ $user->is_active ? 'BLOKIR' : 'BUKA' }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-muted py-4">Tidak ada data akun pengguna untuk kategori ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.toggle-password-btn').forEach(button => {
        button.addEventListener('click', function () {
            const inputField = this.parentElement.querySelector('.password-field');
            const iconElement = this.querySelector('i');
            
            if (inputField.type === 'password') {
                inputField.type = 'text';
                iconElement.classList.remove('bi-eye-slash');
                iconElement.classList.add('bi-eye');
                iconElement.classList.remove('text-muted');
                iconElement.classList.add('text-primary');
            } else {
                inputField.type = 'password';
                iconElement.classList.remove('bi-eye');
                iconElement.classList.add('bi-eye-slash');
                iconElement.classList.remove('text-primary');
                iconElement.classList.add('text-muted');
            }
        });
    });
</script>

<style>
    .btn-action {
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        border-radius: 4px;
    }
</style>
@endsection