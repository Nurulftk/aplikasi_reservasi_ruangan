@extends('layouts.app')
@section('title', 'Edit Pengguna')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" class="text-decoration-none" style="font-size:0.875rem;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Data Pengguna
    </a>
    <h4 class="fw-bold mt-2">Edit Pengguna</h4>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px; max-width:600px;">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.users.update', $user->id_user) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->nama) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">NIM</label>
                <input type="text" name="nim" class="form-control" value="{{ old('nim', $user->nim) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password <small class="text-muted">(kosongkan jika tidak ingin mengubah)</small></label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Role</label>
                <select name="role" class="form-select" required>
                    <option value="mahasiswa" {{ old('role', $user->role) == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg me-1"></i> Perbarui
            </button>
        </form>
    </div>
</div>
@endsection
