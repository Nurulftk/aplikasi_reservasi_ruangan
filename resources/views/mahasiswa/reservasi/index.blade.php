@extends('layouts.app')
@section('title', 'Status Reservasi')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="fw-bold mb-0">Status Reservasi Saya</h4>
    <a href="{{ route('mahasiswa.reservasi.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Buat Reservasi
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
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
                        <td class="fw-semibold">{{ $r->ruangan->nama_ruangan ?? '-' }}</td>
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
                                <form action="{{ route('mahasiswa.reservasi.cancel', $r->id_reservasi) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-x-lg"></i> Batalkan
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Belum ada reservasi. <a href="{{ route('mahasiswa.reservasi.create') }}">Buat sekarang</a></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
