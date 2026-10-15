<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_ruangan',
        'id_reservasi',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'keterangan',
    ];

    public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan', 'id_ruangan');
    }

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }
}
