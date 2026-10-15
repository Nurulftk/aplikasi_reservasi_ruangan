@extends('layouts.auth')
@section('title', 'Login')

@section('content')
<div class="auth-header">
    <h3><i class="bi bi-building"></i> ReservasiKu</h3>
    <p>Sistem Reservasi Ruangan Kampus</p>
</div>
<div class="auth-body">
    <h5 class="mb-3 fw-bold">Masuk ke Akun</h5>

    @if($errors->any())
        <div class="alert alert-danger py-2" style="font-size:0.875rem;">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
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
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-2">
            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
        </button>
    </form>

    <div class="text-center mt-3" style="font-size:0.875rem;">
        Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold" style="color:#8b1a3f;">Daftar disini</a>
    </div>
</div>
@endsection
