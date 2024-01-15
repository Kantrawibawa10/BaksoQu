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

    public function approvel(Request $request)
    {
        if($request->aksi == 'Menyelesaikan transaksi')
        {
            $stok = Cars::select('unit')->where('id_car', $request->id_car)->first();
            $aprovel = Cars::updateOrCreate(['id_car' => $request['id_car']], [
                'unit' => $stok->unit - 1,
            ]);
        }

        $aprovel = Rental::updateOrCreate(['id_rental' => $request['id_rental']], [
            'status_rental' => $request->status,
        ]);

        $aprovel = Transactions::updateOrCreate(['id_rental' => $request['id_rental']], [
            'is_complete' => $request->is_complete,
        ]);

        if($request->status == "batal")
        {
            $cek = Payment::where('id_transaction', $request['id_transaction'])->first();
            $filePath = public_path('drive/kategori' . '/' . $cek->payment_image);
            if (file_exists($filePath)) {
                unlink($filePath);
            } else {
                    // Handle the case where the file doesn't exist if necessary
            }
            $aprovel = Transactions::where('id_rental', $request['id_rental'])->delete();
            $aprovel = Payment::where('id_transaction', $request['id_transaction'])->delete();
        }

        if($aprovel)
        {
            toast($request->aksi.' berhasil dilakukan','success');
            return redirect()->back();
        }
    }

}

