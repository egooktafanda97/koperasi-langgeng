<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Unit extends Model
{
    use HasFactory;
    use LogsActivity;
    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['nama_unit', 'kategori_usaha_id', 'penanggung_jawab', 'phone', 'alamat', 'deskripsi'])
            ->logOnlyDirty();
    }
    protected static $logName = 'unit';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true; // hanya field yang berubah
    protected $fillable = [
        'nama_unit',
        'kategori_usaha_id',
        'penanggung_jawab',
        'phone',
        'alamat',
        'deskripsi'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function produk()
    {
        return $this->hasMany(ProdukUnit::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }

    //user
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'unit_id');
    }

    public function kategoriUsaha()
    {
        return $this->belongsTo(KategoriUsaha::class);
    }

    public function getKategoriUsahaNameAttribute()
    {
        return $this->kategoriUsaha ? $this->kategoriUsaha->nama_kategori : '-';
    }
}
