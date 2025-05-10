<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected static $logName = 'pengumuman';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true; // hanya field yang berubah

    use LogsActivity;
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['judul', 'isi', 'file_lampiran', 'tampilkan'])
            ->logOnlyDirty();
    }

    protected $fillable = [
        'judul',
        'isi',
        'file_lampiran',
        'tampilkan',
    ];
}
