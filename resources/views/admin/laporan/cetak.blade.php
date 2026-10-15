<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Reservasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; padding: 2rem; }
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; }
        }
    </style>
</head>
<body>
    <div class="text-center mb-4">
        <h4 class="fw-bold">LAPORAN RESERVASI RUANGAN</h4>
        <p class="text-muted">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table class="table table-bordered table-sm">
        <thead class="table-dark">
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
            @foreach($reservasi as $i => $r)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $r->user->nama ?? '-' }}</td>
                <td>{{ $r->user->nim ?? '-' }}</td>
                <td>{{ $r->ruangan->nama_ruangan ?? '-' }}</td>
                <td>{{ $r->ruangan->gedung ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d/m/Y') }}</td>
                <td>{{ substr($r->jam_mulai, 0, 5) }} - {{ substr($r->jam_selesai, 0, 5) }}</td>
                <td>{{ $r->keperluan }}</td>
                <td>{{ ucfirst($r->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="mt-3">Total: {{ $reservasi->count() }} reservasi</p>

    <button class="btn btn-primary no-print mt-3" onclick="window.print()">
        <i class="bi bi-printer"></i> Cetak Halaman
    </button>
</body>
</html>
