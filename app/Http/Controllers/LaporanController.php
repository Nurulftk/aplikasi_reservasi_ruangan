<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Reservasi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservasi::with(['user', 'ruangan']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('dari_tanggal')) {
            $query->where('tanggal', '>=', $request->dari_tanggal);
        }

        if ($request->filled('sampai_tanggal')) {
            $query->where('tanggal', '<=', $request->sampai_tanggal);
        }

        $reservasi = $query->orderBy('tanggal', 'desc')->get();

        return view('admin.laporan.index', compact('reservasi'));
    }

    public function cetak(Request $request)
    {
        $query = Reservasi::with(['user', 'ruangan']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('dari_tanggal')) {
            $query->where('tanggal', '>=', $request->dari_tanggal);
        }

        if ($request->filled('sampai_tanggal')) {
            $query->where('tanggal', '<=', $request->sampai_tanggal);
        }

        $reservasi = $query->orderBy('tanggal', 'desc')->get();

        // Save laporan record
        foreach ($reservasi as $r) {
            Laporan::create([
                'id_reservasi' => $r->id_reservasi,
                'tanggal_cetak' => now()->toDateString(),
                'keterangan' => 'Laporan dicetak pada ' . now()->format('d/m/Y H:i'),
            ]);
        }

        return view('admin.laporan.cetak', compact('reservasi'));
    }
}
