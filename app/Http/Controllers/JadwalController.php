<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $ruanganList = Ruangan::all();
        $query = Jadwal::with(['ruangan', 'reservasi.user']);

        if ($request->filled('id_ruangan')) {
            $query->where('id_ruangan', $request->id_ruangan);
        }

        if ($request->filled('tanggal')) {
            $query->where('tanggal', $request->tanggal);
        }

        $jadwal = $query->orderBy('tanggal', 'asc')->orderBy('jam_mulai', 'asc')->get();

        $viewPrefix = auth()->user()->isAdmin() ? 'admin' : 'mahasiswa';
        return view($viewPrefix . '.jadwal.index', compact('jadwal', 'ruanganList'));
    }
}
