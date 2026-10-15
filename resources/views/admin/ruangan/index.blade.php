@extends('layouts.app')
@section('title', 'Data Ruangan')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <h4 class="fw-bold mb-0">Data Ruangan</h4>
    <a href="{{ route('admin.ruangan.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i> Tambah Ruangan
    </a>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Ruangan</th>
                        <th>Gedung</th>
                        <th>Kapasitas</th>
                        <th>Fasilitas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ruangan as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td class="fw-semibold">{{ $r->nama_ruangan }}</td>
                        <td>{{ $r->gedung }}</td>
                        <td>{{ $r->kapasitas }} orang</td>
                        <td><small>{{ Str::limit($r->fasilitas, 40) }}</small></td>
                        <td>
                            @if($r->status == 'tersedia')
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-secondary">Tidak Tersedia</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.ruangan.edit', $r->id_ruangan) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.ruangan.destroy', $r->id_ruangan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ruangan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data ruangan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
