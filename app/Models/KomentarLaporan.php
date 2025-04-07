<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarLaporan extends Model
{
    use HasFactory;

    protected $table = 'komentar_laporan';

    public $timestamps = false;

    protected $fillable = ['laporan_id', 'admin_id', 'isi_komentar'];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
