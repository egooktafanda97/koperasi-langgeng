<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Laporan extends Model
{
    use HasFactory;
    protected static $logName = 'laporan';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true; // hanya field yang berubah

    protected $table = 'laporan';

    use LogsActivity;
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['unit_id', 'bulan', 'file_laporan', 'pendapatan', 'pengeluaran', 'status', 'catatan_admin', 'keterangan'])
            ->logOnlyDirty();
    }

    protected $fillable = [
        'unit_id',
        'bulan',
        'file_laporan',
        'pendapatan',
        'pengeluaran',
        'status',
        'catatan_admin',
        'keterangan'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function komentar()
    {
        return $this->hasMany(KomentarLaporan::class);
    }

    public function getKeuntunganAttribute()
    {
        return $this->pendapatan - $this->pengeluaran;
    }
}
