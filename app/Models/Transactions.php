<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = [
        'id',
        'id_transaksi',
        'id_produk',
        'nama_produk',
        'qty',
        'harga_produk',
        'id_users',
        'nama_pelanggan',
        'user_acc',
        'tgl_transaksi',
        'close_transaksi',
        'status',
    ];
}
