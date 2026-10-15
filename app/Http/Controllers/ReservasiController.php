<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Reservasi;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    // === Admin: List all reservations ===
    public function adminIndex(Request $request)
    {
        $query = Reservasi::with(['user', 'ruangan']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reservasi = $query->latest('created_at')->get();
        return view('admin.reservasi.index', compact('reservasi'));
    }

    // === Admin: Approve a reservation ===
    public function approve($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status' => 'diterima']);

        // Create jadwal automatically
        Jadwal::create([
            'id_ruangan' => $reservasi->id_ruangan,
            'id_reservasi' => $reservasi->id_reservasi,
            'tanggal' => $reservasi->tanggal,
            'jam_mulai' => $reservasi->jam_mulai,
            'jam_selesai' => $reservasi->jam_selesai,
            'keterangan' => 'Reservasi disetujui - ' . $reservasi->keperluan,
        ]);

        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil disetujui dan jadwal dibuat.');
    }

    // === Admin: Reject a reservation ===
    public function reject($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $reservasi->update(['status' => 'ditolak']);

        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil ditolak.');
    }

    // === Mahasiswa: My reservations ===
    public function myReservasi()
    {
        $reservasi = Reservasi::with('ruangan')
            ->where('id_user', auth()->user()->id_user)
            ->latest('created_at')
            ->get();

        return view('mahasiswa.reservasi.index', compact('reservasi'));
    }

    // === Mahasiswa: Create reservation form ===
    public function create()
    {
        $ruangan = Ruangan::where('status', 'tersedia')->get();
        $reservasiData = Reservasi::whereNotIn('status', ['ditolak', 'dibatalkan'])
            ->get(['id_ruangan', 'tanggal', 'jam_mulai', 'jam_selesai', 'jumlah_orang']);

        return view('mahasiswa.reservasi.create', compact('ruangan', 'reservasiData'));
    }

    // === Mahasiswa: Store new reservation ===
    public function store(Request $request)
    {
        $request->validate([
            'id_ruangan' => 'required|exists:ruangan,id_ruangan',
            'tanggal' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keperluan' => 'required|string',
            'jumlah_orang' => 'required|integer|min:1',
        ]);

        $ruangan = Ruangan::findOrFail($request->id_ruangan);

        if ($request->jumlah_orang > $ruangan->kapasitas) {
            return back()->withErrors(['jumlah_orang' => 'Jumlah orang melebihi kapasitas ruangan.'])->withInput();
        }

        $existingSeats = Reservasi::where('id_ruangan', $request->id_ruangan)
            ->where('tanggal', $request->tanggal)
            ->whereNotIn('status', ['ditolak', 'dibatalkan'])
            ->where(function ($q) use ($request) {
                $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhere(function ($q2) use ($request) {
                      $q2->where('jam_mulai', '<=', $request->jam_mulai)
                         ->where('jam_selesai', '>=', $request->jam_selesai);
                  });
            })
            ->sum('jumlah_orang');

        if ($existingSeats + $request->jumlah_orang > $ruangan->kapasitas) {
            return back()->withErrors(['jumlah_orang' => 'Kapasitas ruangan tidak cukup untuk jumlah orang yang diajukan.'])->withInput();
        }

        Reservasi::create([
            'id_user' => auth()->user()->id_user,
            'id_ruangan' => $request->id_ruangan,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keperluan' => $request->keperluan,
            'jumlah_orang' => $request->jumlah_orang,
            'status' => 'menunggu',
        ]);

        return redirect()->route('mahasiswa.reservasi.index')->with('success', 'Reservasi berhasil diajukan.');
    }

    // === Mahasiswa: Cancel reservation ===
    public function cancel($id)
    {
        $reservasi = Reservasi::where('id_reservasi', $id)
            ->where('id_user', auth()->user()->id_user)
            ->where('status', 'menunggu')
            ->firstOrFail();

        // Mark as cancelled instead of deleting so it remains visible in lists
        $reservasi->update(['status' => 'dibatalkan']);

        return redirect()->route('mahasiswa.reservasi.index')->with('success', 'Reservasi berhasil dibatalkan.');
    }
}
