@extends('layouts.app')
@section('title', 'Data Reservasi')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="fw-bold mb-0">Data Reservasi</h4>
</div>

{{-- Filter --}}
<div class="card border-0 shadow-sm mb-3" style="border-radius:12px;">
    <div class="card-body py-2">
        <form method="GET" class="d-flex align-items-center gap-2">
            <label class="fw-semibold me-1" style="font-size:0.85rem;">Filter:</label>
            <select name="status" class="form-select form-select-sm" style="max-width:180px;">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
            <button class="btn btn-primary btn-sm"><i class="bi bi-funnel"></i> Filter</button>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Mahasiswa</th>
                        <th>NIM</th>
                        <th>Ruangan</th>
                        <th>Jumlah Orang</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Keperluan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservasi as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-semibold">{{ $r->user->nama ?? '-' }}</td>
                        <td>{{ $r->user->nim ?? '-' }}</td>
                        <td>{{ $r->ruangan->nama_ruangan ?? '-' }}</td>
                        <td>{{ $r->jumlah_orang }} orang</td>
                        <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ substr($r->jam_mulai, 0, 5) }} - {{ substr($r->jam_selesai, 0, 5) }}</td>
                        <td><small>{{ Str::limit($r->keperluan, 30) }}</small></td>
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
                        <td>
                            @if($r->status == 'menunggu')
                            <div class="d-flex gap-1">
                                <form action="{{ route('admin.reservasi.approve', $r->id_reservasi) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-success" title="Setujui" onclick="return confirm('Setujui reservasi ini?')">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                                <form action="{{ route('admin.reservasi.reject', $r->id_reservasi) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-danger" title="Tolak" onclick="return confirm('Tolak reservasi ini?')">
                                        <i class="bi bi-x-lg"></i>
                                    </button>
                                </form>
                            </div>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">Belum ada data reservasi.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
