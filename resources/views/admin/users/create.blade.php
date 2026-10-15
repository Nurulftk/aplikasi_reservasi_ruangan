@extends('layouts.app')
@section('title', 'Tambah Pengguna')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" class="text-decoration-none" style="font-size:0.875rem;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Data Pengguna
    </a>
    <h4 class="fw-bold mt-2">Tambah Pengguna Baru</h4>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px; max-width:600px;">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">NIM</label>
                <input type="text" name="nim" class="form-control" value="{{ old('nim') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Role</label>
                <select name="role" class="form-select" required>
                    <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg me-1"></i> Simpan
            </button>
        </form>
    </div>
</div>
@endsection
