<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class KategoriUsaha extends Model
{
    use HasFactory;
    protected static $logName = 'kategori_usaha';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true; // hanya field yang berubah

    protected $table = 'kategori_usaha';
    use LogsActivity;
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['nama_kategori', 'deskripsi'])
            ->logOnlyDirty();
    }

    protected $fillable = ['nama_kategori', 'deskripsi'];
}
