@extends('layouts.app')
@section('title', 'Laporan Reservasi')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold mb-0">Laporan Reservasi</h4>
        <p class="text-muted mb-0" style="font-size:0.875rem;">Rekap data reservasi ruangan.</p>
    </div>
</div>

{{-- Filter --}}
<div class="card border-0 shadow-sm mb-3" style="border-radius:12px;">
    <div class="card-body py-2">
        <form method="GET" class="d-flex align-items-center gap-2 flex-wrap">
            <label class="fw-semibold" style="font-size:0.85rem;">Dari:</label>
            <input type="date" name="dari_tanggal" class="form-control form-control-sm" style="max-width:160px;" value="{{ request('dari_tanggal') }}">
            <label class="fw-semibold" style="font-size:0.85rem;">Sampai:</label>
            <input type="date" name="sampai_tanggal" class="form-control form-control-sm" style="max-width:160px;" value="{{ request('sampai_tanggal') }}">
            <select name="status" class="form-select form-select-sm" style="max-width:160px;">
                <option value="">Semua Status</option>
                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button class="btn btn-primary btn-sm"><i class="bi bi-funnel"></i> Filter</button>
            <a href="{{ route('admin.laporan.cetak', request()->query()) }}" class="btn btn-outline-secondary btn-sm" target="_blank">
                <i class="bi bi-printer"></i> Cetak
            </a>
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
                        <th>Gedung</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Keperluan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservasi as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $r->user->nama ?? '-' }}</td>
                        <td>{{ $r->user->nim ?? '-' }}</td>
                        <td>{{ $r->ruangan->nama_ruangan ?? '-' }}</td>
                        <td>{{ $r->ruangan->gedung ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ substr($r->jam_mulai, 0, 5) }} - {{ substr($r->jam_selesai, 0, 5) }}</td>
                        <td><small>{{ $r->keperluan }}</small></td>
                        <td>
                            @if($r->status == 'menunggu')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($r->status == 'diterima')
                                <span class="badge bg-success">Diterima</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center text-muted py-4">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="text-muted mt-2" style="font-size:0.8rem;">
    Total: {{ $reservasi->count() }} reservasi
</div>
@endsection
