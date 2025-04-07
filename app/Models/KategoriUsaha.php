<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriUsaha extends Model
{
    use HasFactory;

    protected $table = 'kategori_usaha';

    protected $fillable = ['nama_kategori', 'deskripsi'];
}
