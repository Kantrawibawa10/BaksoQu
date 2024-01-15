<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function _construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $data = [
            'order'         => Transactions::where('status', 'proses')->orWhere('status', 'payment')->get(),
            'penghasilan'   => Transactions::where('status', 'selesai')->get(),
            'transaksi'     => Transactions::join('invoices', 'invoices.id_transaksi', '=', 'transactions.id_transaksi')
                                ->select('transactions.*', 'invoices.id_invoice')
                                ->get()
                                ->unique('id_transaksi'),
            'dataTransaksi' => Transactions::all()
        ];

        return view('admin.dashboard', $data);
    }
}
