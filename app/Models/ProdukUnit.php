<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukUnit extends Model
{
    use HasFactory;
    protected static $logName = 'produk_unit';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true; // hanya field yang berubah
    protected $table = 'produk_unit';

    protected $fillable = [
        'unit_id',
        'nama_produk',
        'jenis_produk',
        'keterangan',
        'satuan'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
