@extends('layouts.app')
@section('title', 'Buat Reservasi')

@section('content')
<div class="mb-4">
    <a href="{{ route('mahasiswa.reservasi.index') }}" class="text-decoration-none" style="font-size:0.875rem;">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Status Reservasi
    </a>
    <h4 class="fw-bold mt-2">Buat Reservasi Ruangan</h4>
</div>

<div class="card border-0 shadow-sm" style="border-radius:12px; max-width:600px;">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('mahasiswa.reservasi.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Ruangan</label>
                <select name="id_ruangan" class="form-select" required>
                    <option value="">-- Pilih Ruangan --</option>
                    @foreach($ruangan as $r)
                        <option value="{{ $r->id_ruangan }}" {{ old('id_ruangan') == $r->id_ruangan ? 'selected' : '' }}>
                            {{ $r->nama_ruangan }} — {{ $r->gedung }} ({{ $r->kapasitas }} orang)
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required min="{{ date('Y-m-d') }}">
            </div>
            <div class="row">
                <div class="col-6 mb-3">
                    <label class="form-label fw-semibold">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai') }}" required>
                </div>
                <div class="col-6 mb-3">
                    <label class="form-label fw-semibold">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Jumlah Orang</label>
                    <input id="jumlah_orang" type="number" name="jumlah_orang" class="form-control" value="{{ old('jumlah_orang', 1) }}" min="1" required>
                    <small class="text-muted">Jumlah orang yang akan menggunakan ruangan.</small>
                    <div id="sisa_kapasitas" class="form-text text-muted mt-1">Pilih ruangan dan waktu untuk melihat kapasitas tersisa.</div>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Kapasitas Ruangan</label>
                    <input id="kapasitas_ruangan" type="text" class="form-control" value="Pilih ruangan untuk melihat kapasitas" disabled>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Keperluan</label>
                <textarea name="keperluan" class="form-control" rows="3" required placeholder="Jelaskan keperluan penggunaan ruangan...">{{ old('keperluan') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-send me-1"></i> Ajukan Reservasi
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const rooms = @json($ruangan->map(fn($room) => ['id' => $room->id_ruangan, 'kapasitas' => $room->kapasitas]));
    const existingReservations = @json($reservasiData);

    const roomSelect = document.querySelector('select[name="id_ruangan"]');
    const tanggalInput = document.querySelector('input[name="tanggal"]');
    const jamMulaiInput = document.querySelector('input[name="jam_mulai"]');
    const jamSelesaiInput = document.querySelector('input[name="jam_selesai"]');
    const jumlahOrangInput = document.getElementById('jumlah_orang');
    const kapasitasField = document.getElementById('kapasitas_ruangan');
    const sisaKapasitas = document.getElementById('sisa_kapasitas');

    function getRoomCapacity(roomId) {
        const room = rooms.find(r => r.id == roomId);
        return room ? room.kapasitas : null;
    }

    function getReservedSeats(roomId, tanggal, jamMulai, jamSelesai) {
        if (!roomId || !tanggal || !jamMulai || !jamSelesai) {
            return 0;
        }

        return existingReservations.reduce((sum, reservasi) => {
            if (reservasi.id_ruangan != roomId || reservasi.tanggal !== tanggal) {
                return sum;
            }

            const start1 = reservasi.jam_mulai;
            const end1 = reservasi.jam_selesai;
            const start2 = jamMulai;
            const end2 = jamSelesai;

            const overlap = (start1 <= end2 && end1 >= start2);
            if (overlap) {
                return sum + Number(reservasi.jumlah_orang);
            }
            return sum;
        }, 0);
    }

    function updateCapacityInfo() {
        const roomId = roomSelect.value;
        const tanggal = tanggalInput.value;
        const jamMulai = jamMulaiInput.value;
        const jamSelesai = jamSelesaiInput.value;

        const capacity = getRoomCapacity(roomId);
        if (!roomId) {
            kapasitasField.value = 'Pilih ruangan untuk melihat kapasitas';
            sisaKapasitas.textContent = 'Pilih ruangan dan waktu untuk melihat kapasitas tersisa.';
            return;
        }

        kapasitasField.value = capacity + ' orang';

        if (!tanggal || !jamMulai || !jamSelesai) {
            sisaKapasitas.textContent = 'Isi tanggal dan jam untuk melihat kapasitas tersisa.';
            return;
        }

        let reserved = getReservedSeats(roomId, tanggal, jamMulai, jamSelesai);
        let remaining = capacity - reserved;
        if (remaining < 0) {
            remaining = 0;
        }

        sisaKapasitas.textContent = `Kapasitas tersisa: ${remaining} orang dari ${capacity} orang`;

        const requested = Number(jumlahOrangInput.value) || 0;
        if (requested > remaining) {
            sisaKapasitas.classList.remove('text-muted');
            sisaKapasitas.classList.add('text-danger');
            sisaKapasitas.textContent = `Kapasitas tidak cukup. Sisa ${remaining} orang.`;
        } else {
            sisaKapasitas.classList.remove('text-danger');
            sisaKapasitas.classList.add('text-muted');
        }
    }

    [roomSelect, tanggalInput, jamMulaiInput, jamSelesaiInput, jumlahOrangInput].forEach(el => {
        el.addEventListener('change', updateCapacityInfo);
        el.addEventListener('input', updateCapacityInfo);
    });

    updateCapacityInfo();
</script>
@endpush
@endsection
