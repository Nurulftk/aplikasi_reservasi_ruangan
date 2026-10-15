<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === Admin Account ===
        User::create([
            'nama' => 'Administrator',
            'nim' => 'ADM001',
            'email' => 'admin@reservasi.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        // === Mahasiswa Account ===
        User::create([
            'nama' => 'Budi Santoso',
            'nim' => '2024001',
            'email' => 'mahasiswa@reservasi.com',
            'password' => 'password',
            'role' => 'mahasiswa',
        ]);

        User::create([
            'nama' => 'Siti Nurhaliza',
            'nim' => '2024002',
            'email' => 'siti@reservasi.com',
            'password' => 'password',
            'role' => 'mahasiswa',
        ]);

        // === Sample Ruangan ===
        Ruangan::create([
            'nama_ruangan' => 'Lab Komputer 1',
            'gedung' => 'Gedung A',
            'kapasitas' => 40,
            'fasilitas' => 'Proyektor, AC, 40 Unit PC, Whiteboard',
            'status' => 'tersedia',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Lab Komputer 2',
            'gedung' => 'Gedung A',
            'kapasitas' => 30,
            'fasilitas' => 'Proyektor, AC, 30 Unit PC',
            'status' => 'tersedia',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruang Seminar',
            'gedung' => 'Gedung B',
            'kapasitas' => 100,
            'fasilitas' => 'Proyektor, AC, Sound System, Podium, 100 Kursi',
            'status' => 'tersedia',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Ruang Rapat',
            'gedung' => 'Gedung B',
            'kapasitas' => 20,
            'fasilitas' => 'Proyektor, AC, Meja Rapat, Whiteboard',
            'status' => 'tersedia',
        ]);

        Ruangan::create([
            'nama_ruangan' => 'Aula Utama',
            'gedung' => 'Gedung C',
            'kapasitas' => 300,
            'fasilitas' => 'Proyektor, AC, Sound System, Panggung, 300 Kursi',
            'status' => 'tersedia',
        ]);

        // === Tambah Gedung baru dengan 4 lantai x 10 ruangan per lantai ===
        $gedungName = 'Gedung D';
        $defaultKapasitas = 20;
        $defaultFasilitas = 'AC, TV, Proyektor';

        for ($lantai = 1; $lantai <= 4; $lantai++) {
            for ($num = 1; $num <= 10; $num++) {
                // Create room number like 101, 102 ... 210, ... 410
                $roomNumber = $lantai * 100 + $num; // e.g. 1*100 + 1 = 101
                $roomName = 'Ruang ' . $roomNumber;

                Ruangan::create([
                    'nama_ruangan' => $roomName,
                    'gedung' => $gedungName,
                    'kapasitas' => $defaultKapasitas,
                    'fasilitas' => $defaultFasilitas,
                    'status' => 'tersedia',
                ]);
            }
        }
    }
}
