<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class KomentarLaporan extends Model
{
    use HasFactory;
    protected static $logName = 'komentar_laporan';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true; // hanya field yang berubah

    protected $table = 'komentar_laporan';

    use LogsActivity;
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['laporan_id', 'admin_id', 'isi_komentar'])
            ->logOnlyDirty();
    }

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
