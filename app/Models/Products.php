<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'id',
        'photo',
        'kode_produk',
        'kategori_produk',
        'nama_produk',
        'harga_produk',
        'ppn',
        'status',
        'stock',
        'deskripsi',
    ];
}
