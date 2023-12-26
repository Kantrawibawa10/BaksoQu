<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice';

    protected $fillable = [
        'id',
        'id_invoice',
        'id_transaksi',
        'qty',
        'total_harga',
        'status',
    ];
}
