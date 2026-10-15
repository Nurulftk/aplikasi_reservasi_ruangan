<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';

    protected $fillable = [
        'id_user',
        'id_ruangan',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'keperluan',
        'jumlah_orang',
        'status',
    ];

    public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan', 'id_ruangan');
    }

    public function jadwal()
    {
        return $this->hasOne(Jadwal::class, 'id_reservasi', 'id_reservasi');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_reservasi', 'id_reservasi');
    }
}
