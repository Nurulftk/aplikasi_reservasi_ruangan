<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama',
        'nim',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = null;

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_user', 'id_user');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }
}
