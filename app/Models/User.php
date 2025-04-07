<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'unit_id',
        'phone',
        'address'
    ];

    protected $hidden = ['password'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class);
    }

    public function komentar()
    {
        return $this->hasMany(KomentarLaporan::class, 'admin_id');
    }
}
