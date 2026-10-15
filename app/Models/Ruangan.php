<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $primaryKey = 'id_ruangan';

    protected $fillable = [
        'nama_ruangan',
        'gedung',
        'kapasitas',
        'fasilitas',
        'status',
    ];

    public $timestamps = false;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_ruangan', 'id_ruangan');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_ruangan', 'id_ruangan');
    }
}
