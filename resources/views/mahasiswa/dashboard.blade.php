@extends('layouts.app')
@section('title', 'Dashboard Mahasiswa')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-1">Dashboard</h4>
    <p class="text-muted mb-0" style="font-size:0.875rem;">Selamat datang, {{ auth()->user()->nama }}!</p>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-3 col-sm-6">
        <a href="{{ route('mahasiswa.reservasi.index') }}" class="text-decoration-none text-reset">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="bi bi-calendar-check"></i></div>
                    <div>
                        <div class="stat-value">{{ $totalReservasi }}</div>
                        <div class="stat-label">Total Reservasi</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6">
        <a href="{{ route('mahasiswa.reservasi.index', ['status' => 'menunggu']) }}" class="text-decoration-none text-reset">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-clock"></i></div>
                    <div>
                        <div class="stat-value">{{ $reservasiMenunggu }}</div>
                        <div class="stat-label">Menunggu</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6">
        <a href="{{ route('mahasiswa.reservasi.index', ['status' => 'diterima']) }}" class="text-decoration-none text-reset">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="bi bi-check-circle"></i></div>
                    <div>
                        <div class="stat-value">{{ $reservasiDiterima }}</div>
                        <div class="stat-label">Diterima</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3 col-sm-6">
        <a href="{{ route('mahasiswa.reservasi.index', ['status' => 'ditolak']) }}" class="text-decoration-none text-reset">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger"><i class="bi bi-x-circle"></i></div>
                    <div>
                        <div class="stat-value">{{ $reservasiDitolak }}</div>
                        <div class="stat-label">Ditolak</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

{{-- Quick Actions --}}
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <a href="{{ route('mahasiswa.reservasi.create') }}" class="card stat-card text-decoration-none" style="border-left:4px solid #8b1a3f;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="bi bi-plus-circle-fill"></i></div>
                <div>
                    <div class="fw-bold text-dark">Buat Reservasi Baru</div>
                    <small class="text-muted">Ajukan reservasi ruangan</small>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-6">
        <a href="{{ route('mahasiswa.jadwal.index') }}" class="card stat-card text-decoration-none" style="border-left:4px solid #10b981;">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="bi bi-calendar3"></i></div>
                <div>
                    <div class="fw-bold text-dark">Lihat Jadwal</div>
                    <small class="text-muted">Cek jadwal penggunaan ruangan</small>
                </div>
            </div>
        </a>
    </div>
</div>

{{-- Recent --}}
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-header bg-white border-0 py-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2"></i>Reservasi Terbaru Saya</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentReservasi as $r)
                    <tr>
                        <td>{{ $r->ruangan->nama_ruangan ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ substr($r->jam_mulai, 0, 5) }} - {{ substr($r->jam_selesai, 0, 5) }}</td>
                        <td>
                                @if($r->status == 'menunggu')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($r->status == 'diterima')
                                    <span class="badge bg-success">Diterima</span>
                                @elseif($r->status == 'dibatalkan')
                                    <span class="badge bg-secondary text-white">Dibatalkan</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted py-4">Belum ada reservasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
