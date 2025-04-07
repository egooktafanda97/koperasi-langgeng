<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_unit',
        'jenis_usaha',
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
}
