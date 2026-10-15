@extends('layouts.auth')
@section('title', 'Daftar')

@section('content')
<div class="auth-header">
    <h3><i class="bi bi-building"></i> ReservasiKu</h3>
    <p>Daftar Akun Mahasiswa Baru</p>
</div>
<div class="auth-body">
    <h5 class="mb-3 fw-bold">Buat Akun Baru</h5>

    @if($errors->any())
        <div class="alert alert-danger py-2" style="font-size:0.875rem;">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold" style="font-size:0.875rem;">Nama Lengkap</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" value="{{ old('nama') }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" style="font-size:0.875rem;">NIM</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                <input type="text" name="nim" class="form-control" placeholder="Nomor Induk Mahasiswa" value="{{ old('nim') }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" style="font-size:0.875rem;">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" style="font-size:0.875rem;">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" style="font-size:0.875rem;">Konfirmasi Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-2">
            <i class="bi bi-person-plus me-1"></i> Daftar
        </button>
    </form>

    <div class="text-center mt-3" style="font-size:0.875rem;">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold" style="color:#8b1a3f;">Masuk disini</a>
    </div>
</div>
@endsection
