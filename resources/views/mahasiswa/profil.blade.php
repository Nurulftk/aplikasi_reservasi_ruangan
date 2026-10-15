@extends('layouts.app')
@section('title', 'Profil Saya')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Profil Saya</h4>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px; max-width:600px;">
    <div class="card-body p-4">
        {{-- Profile Header --}}
        <div class="text-center mb-4">
            <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#8b1a3f,#f7d7e1);color:#fff;display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:700;margin:0 auto;">
                {{ strtoupper(substr($user->nama, 0, 1)) }}
            </div>
            <h5 class="fw-bold mt-3 mb-0">{{ $user->nama }}</h5>
            <span class="badge bg-info mt-1">{{ ucfirst($user->role) }}</span>
        </div>

        <hr>

        <form method="POST" action="{{ route('mahasiswa.profil.update') }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->nama) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">NIM</label>
                <input type="text" class="form-control" value="{{ $user->nim }}" disabled>
                <small class="text-muted">NIM tidak dapat diubah.</small>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>
            <hr>
            <p class="fw-semibold mb-2">Ubah Password <small class="text-muted fw-normal">(opsional)</small></p>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password Baru</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
