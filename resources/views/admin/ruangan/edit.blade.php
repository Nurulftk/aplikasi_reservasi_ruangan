@extends('layouts.app')
@section('title', 'Edit Ruangan')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.ruangan.index') }}" class="text-decoration-none" style="font-size:0.875rem;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Data Ruangan
    </a>
    <h4 class="fw-bold mt-2">Edit Ruangan</h4>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px; max-width:600px;">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.ruangan.update', $ruangan->id_ruangan) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Ruangan</label>
                <input type="text" name="nama_ruangan" class="form-control" value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Gedung</label>
                <input type="text" name="gedung" class="form-control" value="{{ old('gedung', $ruangan->gedung) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Kapasitas</label>
                <input type="number" name="kapasitas" class="form-control" value="{{ old('kapasitas', $ruangan->kapasitas) }}" required min="1">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Fasilitas</label>
                <textarea name="fasilitas" class="form-control" rows="3">{{ old('fasilitas', $ruangan->fasilitas) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select" required>
                    <option value="tersedia" {{ old('status', $ruangan->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="tidak tersedia" {{ old('status', $ruangan->status) == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg me-1"></i> Perbarui
            </button>
        </form>
    </div>
</div>
@endsection
