<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Models\Transactions;

class TransaksiUsersController extends Controller
{

    public function index()
    {
        if(auth()->user()->alamat == null)
        {
            return view('homepage.profile');
        }else{
            $data = [
                'transaksi' => Transactions::join('products', 'products.kode_produk', '=', 'transactions.id_produk')
                ->where('id_users', auth()->user()->id)
                ->select('transactions.*', 'products.photo', 'products.kategori_produk')
                ->get()
                ->unique('id_transaksi'),
            ];

            return view('homepage.transaksi.index', $data);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transfer'              => 'required|file|max:2000',
        ], [
            'transfer.file'                => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'transfer.max'                 => 'Ukuran Gambar maksimal 2000 KB!',
            'transfer.required'            => 'Gambar tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            toast('Pembayaran transaksi gagal dilakukan','error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $gambar = Transactions::where('id_transaksi', $request->id_transaksi)->first();

        if ($request->hasFile('transfer')) {
            $file = $request->file('transfer');
            if ($file->isValid()) {
                $files = $file->hashName();
                $file->move(public_path('drive/transfer'), $files);
            }
        } else {
            $files = $gambar->transfer ?? null;
        }

        $store = Transactions::where('id_transaksi', $request['id_transaksi'])
        ->update([
            'transfer'      => $files,
            'status'        => 'payment',
            'tgl_transaksi' => now(),
        ]);

        if ($store) {
            toast('Pembayaran transaksi berhasil dilakukan','success');
            return redirect()->back();
        }
    }


    public function detail($id_transaksi)
    {
        $data = [
            'transaksi' => Transactions::join('products', 'products.kode_produk', '=', 'transactions.id_produk')
            ->where('id_transaksi', $id_transaksi)
            ->where('id_users', auth()->user()->id)
            ->select('transactions.*', 'products.photo', 'products.kategori_produk')
            ->get(),

            'invoice'       => Transactions::join('invoices', 'invoices.id_transaksi', '=', 'transactions.id_transaksi')
            ->select('transactions.*', 'invoices.id_invoice')
            ->where('transactions.status', 'selesai')
            ->get()
            ->unique('id_transaksi'),

            'dataTransaksi' => Transactions::where('transactions.status', 'selesai')->get()
        ];

        return view('homepage.transaksi.detail', $data);
    }


    public function destroy($id_transaksi)
    {
        $cek = Transactions::where('id_transaksi', $id_transaksi)->first();
        $filePath = public_path('drive/transfer' . '/' . $cek->transfer);
                if (file_exists($filePath)) {
                    unlink($filePath);
                } else {
                    // Handle the case where the file doesn't exist if necessary
                }
        Transactions::where('id_transaksi', $id_transaksi)->delete();
        toast('Hapus transaksi berhasil dilakukan','success');
        return redirect()->route('transaksi.index');
    }
}
