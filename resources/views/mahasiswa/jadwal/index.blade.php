@extends('layouts.app')
@section('title', 'Jadwal Ruangan')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold mb-0">Jadwal Ruangan</h4>
    <p class="text-muted mb-0" style="font-size:0.875rem;">Jadwal penggunaan ruangan yang sudah disetujui.</p>
</div>

{{-- Filter --}}
<div class="card border-0 shadow-sm mb-3" style="border-radius:12px;">
    <div class="card-body py-2">
        <form method="GET" class="d-flex align-items-center gap-2 flex-wrap">
            <select name="id_ruangan" class="form-select form-select-sm" style="max-width:200px;">
                <option value="">Semua Ruangan</option>
                @foreach($ruanganList as $r)
                    <option value="{{ $r->id_ruangan }}" {{ request('id_ruangan') == $r->id_ruangan ? 'selected' : '' }}>{{ $r->nama_ruangan }}</option>
                @endforeach
            </select>
            <input type="date" name="tanggal" class="form-control form-control-sm" style="max-width:180px;" value="{{ request('tanggal') }}">
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
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jadwal as $i => $j)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-semibold">{{ $j->ruangan->nama_ruangan ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d/m/Y') }}</td>
                        <td>{{ substr($j->jam_mulai, 0, 5) }} - {{ substr($j->jam_selesai, 0, 5) }}</td>
                        <td><small>{{ $j->keterangan }}</small></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada jadwal.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
