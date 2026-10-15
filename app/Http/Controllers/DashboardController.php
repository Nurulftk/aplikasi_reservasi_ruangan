<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalRuangan = Ruangan::count();
        $totalUser = User::where('role', 'mahasiswa')->count();
        $reservasiMenunggu = Reservasi::where('status', 'menunggu')->count();
        $reservasiDiterima = Reservasi::where('status', 'diterima')->count();
        $reservasiDitolak = Reservasi::where('status', 'ditolak')->count();
        $recentReservasi = Reservasi::with(['user', 'ruangan'])
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRuangan', 'totalUser', 'reservasiMenunggu',
            'reservasiDiterima', 'reservasiDitolak', 'recentReservasi'
        ));
    }

    public function mahasiswa()
    {
        $user = auth()->user();
        $totalReservasi = Reservasi::where('id_user', $user->id_user)->count();
        $reservasiMenunggu = Reservasi::where('id_user', $user->id_user)->where('status', 'menunggu')->count();
        $reservasiDiterima = Reservasi::where('id_user', $user->id_user)->where('status', 'diterima')->count();
        $reservasiDitolak = Reservasi::where('id_user', $user->id_user)->where('status', 'ditolak')->count();
        $recentReservasi = Reservasi::with('ruangan')
            ->where('id_user', $user->id_user)
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('mahasiswa.dashboard', compact(
            'totalReservasi', 'reservasiMenunggu',
            'reservasiDiterima', 'reservasiDitolak', 'recentReservasi'
        ));
    }
}
