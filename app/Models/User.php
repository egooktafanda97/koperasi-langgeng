<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasFactory;

    use LogsActivity;
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'email', 'role', 'unit_id', 'phone', 'address'])
            ->logOnlyDirty();
    }


    protected static $logName = 'user';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true; // hanya field yang berubah
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
