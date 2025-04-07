<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'bulan',
        'tahun',
        'file_laporan',
        'pendapatan',
        'pengeluaran',
        'status',
        'catatan_admin'
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
