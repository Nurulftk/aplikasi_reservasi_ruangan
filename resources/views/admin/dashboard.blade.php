@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-1">Dashboard Admin</h4>
        <p class="text-muted mb-0" style="font-size:0.875rem;">Selamat datang, {{ auth()->user()->nama }}!</p>
    </div>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-4 col-sm-6">
        <a href="{{ route('admin.ruangan.index') }}" class="text-decoration-none text-reset">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary"><i class="bi bi-door-open-fill"></i></div>
                    <div>
                        <div class="stat-value">{{ $totalRuangan }}</div>
                        <div class="stat-label">Total Ruangan</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 col-sm-6">
        <a href="{{ route('admin.reservasi.index', ['status' => 'menunggu']) }}" class="text-decoration-none text-reset">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-clock-fill"></i></div>
                    <div>
                        <div class="stat-value">{{ $reservasiMenunggu }}</div>
                        <div class="stat-label">Menunggu Persetujuan</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 col-sm-6">
        <a href="{{ route('admin.reservasi.index', ['status' => 'diterima']) }}" class="text-decoration-none text-reset">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-success bg-opacity-10 text-success"><i class="bi bi-check-circle-fill"></i></div>
                    <div>
                        <div class="stat-value">{{ $reservasiDiterima }}</div>
                        <div class="stat-label">Reservasi Diterima</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 col-sm-6">
        <a href="{{ route('admin.reservasi.index', ['status' => 'ditolak']) }}" class="text-decoration-none text-reset">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger"><i class="bi bi-x-circle-fill"></i></div>
                    <div>
                        <div class="stat-value">{{ $reservasiDitolak }}</div>
                        <div class="stat-label">Reservasi Ditolak</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 col-sm-6">
        <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-reset">
            <div class="card stat-card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-info bg-opacity-10 text-info"><i class="bi bi-people-fill"></i></div>
                    <div>
                        <div class="stat-value">{{ $totalUser }}</div>
                        <div class="stat-label">Total Mahasiswa</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

{{-- Recent Reservations --}}
<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-header bg-white border-0 py-3">
        <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2"></i>Reservasi Terbaru</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Mahasiswa</th>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentReservasi as $r)
                    <tr>
                        <td>{{ $r->user->nama ?? '-' }}</td>
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
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada reservasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
