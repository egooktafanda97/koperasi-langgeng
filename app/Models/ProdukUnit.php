<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukUnit extends Model
{
    use HasFactory;

    protected $table = 'produk_unit';

    protected $fillable = [
        'unit_id',
        'nama_produk',
        'jenis_produk',
        'harga',
        'satuan',
        'stok',
        'keterangan'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
