<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekapitulasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'bulan',
        'tahun',
        'total_unit',
        'total_laporan',
        'total_pendapatan',
        'total_pengeluaran'
    ];

    public $timestamps = false;

    public function getTotalKeuntunganAttribute()
    {
        return $this->total_pendapatan - $this->total_pengeluaran;
    }
}
