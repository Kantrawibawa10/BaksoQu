<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transactions;

class TransaksiController extends Controller
{
    public function terbaru()
    {
        $data = [
            'terbaru' => Transactions::where('status', 'pending')->get()
        ];
        return view('admin.transaksi.terbaru', $data);
    }

    public function proses()
    {
        $data = [
            'proses' => Transactions::where('status', 'proses')->get()
        ];
        return view('admin.transaksi.proses', $data);
    }

    public function selesai()
    {
        $data = [
            'selesai' => Transactions::where('status', 'selesai')->get()
        ];
        return view('admin.transaksi.selesai', $data);
    }

}

