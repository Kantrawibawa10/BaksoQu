<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

use App\Models\Transactions;
use App\Models\Invoice;

class TransaksiController extends Controller
{
    public function terbaru()
    {
        $data = [
            'terbaru'       => Transactions::where('status', 'pending')
                                ->orWhere('status', 'payment')
                                ->get()
                                ->unique('id_transaksi'),
            'dataTransaksi' => Transactions::where('status', 'pending')
                                ->orWhere('status', 'payment')
                                ->get()
        ];
        return view('admin.transaksi.terbaru', $data);
    }

    public function proses()
    {
        $data = [
            'proses'       => Transactions::join('invoices', 'invoices.id_transaksi', '=', 'transactions.id_transaksi')
                                ->select('transactions.*', 'invoices.id_invoice')
                                ->where('transactions.status', 'proses')
                                ->get()
                                ->unique('id_transaksi'),
            'dataTransaksi' => Transactions::where('status', 'proses')
                                ->get()
        ];
        return view('admin.transaksi.proses', $data);
    }

    public function selesai()
    {
        $data = [
            'selesai'       => Transactions::join('invoices', 'invoices.id_transaksi', '=', 'transactions.id_transaksi')
                                ->select('transactions.*', 'invoices.id_invoice')
                                ->where('transactions.status', 'selesai')
                                ->get()
                                ->unique('id_transaksi'),
            'dataTransaksi' => Transactions::where('transactions.status', 'selesai')->get()
        ];
        return view('admin.transaksi.selesai', $data);
    }

    public function batal()
    {
        $data = [
            'batal'       => Transactions::join('invoices', 'invoices.id_transaksi', '=', 'transactions.id_transaksi')
                                ->select('transactions.*', 'invoices.id_invoice')
                                ->where('transactions.status', 'batal')
                                ->get()
                                ->unique('id_transaksi'),
            'dataTransaksi' => Transactions::where('transactions.status', 'batal')->get()
        ];
        return view('admin.transaksi.batal', $data);
    }

    public function posts(Request $request)
    {
        $transaksi = Transactions::where('id_transaksi', $request->id_transaksi)->first();
        $sumQty = $transaksi->sum('qty');
        $sumTotal = $transaksi->sum('harga_produk');


        if($request->aksi == 'Selesaikan pesanan')
        {
            $stok = Products::select('stock')->where('kode_produk', $request->id_produk)->first();
            $aprovel = Products::updateOrCreate(['kode_produk' => $request['id_produk']], [
                'stock' => $stok->stock - $sumQty,
            ]);

            $aprovel = Transactions::where('id_transaksi', $request['id_transaksi'])
            ->update([
                'status'    => 'selesai',
                'user_acc'  => auth()->user()->username,
            ]);
        }

        if($request->aksi == 'Menerima pesanan')
        {

            $id = $request['id'] ? $request['id'] : Invoice::max('id') + 1;
            $id_invoice = 'INV' . str_pad($id, 2, '0', STR_PAD_LEFT) . sprintf('%03d', rand(1, 999));

            $aprovel = Invoice::create([
                'id'            => $id,
                'id_invoice'    => $id_invoice,
                'id_transaksi'  => $request->id_transaksi,
                'qty'           => $sumQty,
                'status'        => 'terbayar',
                'total_harga'   =>  $sumTotal,
            ]);

            $aprovel = Transactions::where('id_transaksi', $request['id_transaksi'])
            ->update([
                'status'    => 'proses',
                'user_acc'  => auth()->user()->username,
            ]);
        }


        if($request->aksi == 'Batalkan pesanan')
        {
            $aprovel = Transactions::where('id_transaksi', $request['id_transaksi'])
            ->update([
                'status'    => 'batal',
                'user_acc'  => auth()->user()->username,
            ]);
        }

        if($aprovel)
        {
            toast($request->aksi.' berhasil dilakukan','success');
            return redirect()->back();
        }
    }

}

