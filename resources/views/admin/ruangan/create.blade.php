@extends('layouts.app')
@section('title', 'Tambah Ruangan')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.ruangan.index') }}" class="text-decoration-none" style="font-size:0.875rem;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Data Ruangan
    </a>
    <h4 class="fw-bold mt-2">Tambah Ruangan Baru</h4>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px; max-width:600px;">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.ruangan.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Ruangan</label>
                <input type="text" name="nama_ruangan" class="form-control" value="{{ old('nama_ruangan') }}" required placeholder="Contoh: Lab Komputer 1">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Gedung</label>
                <input type="text" name="gedung" class="form-control" value="{{ old('gedung') }}" required placeholder="Contoh: Gedung A">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Kapasitas</label>
                <input type="number" name="kapasitas" class="form-control" value="{{ old('kapasitas') }}" required min="1" placeholder="Jumlah orang">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Fasilitas</label>
                <textarea name="fasilitas" class="form-control" rows="3" placeholder="Proyektor, AC, Whiteboard, dll">{{ old('fasilitas') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select" required>
                    <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak tersedia" {{ old('status') == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg me-1"></i> Simpan
            </button>
        </form>
    </div>
</div>
@endsection
