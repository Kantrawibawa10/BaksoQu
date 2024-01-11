<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'id',
        'id_cart',
        'id_produk',
        'nama_produk',
        'qty',
        'harga',
        'id_pelanggan',
        'nama_pelanggan',
    ];
}
