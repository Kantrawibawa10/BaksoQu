<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Response;
use Auth;
use View;
use Illuminate\Support\Facades\DB;

use App\Models\Carts;
use App\Models\Transactions;

class CartController extends Controller
{
    public function getCartData()
    {
        $cart = Carts::join('products', 'products.kode_produk', '=', 'carts.id_produk')
            ->where('id_pelanggan', auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->select('carts.*', 'products.kategori_produk', 'products.photo', 'harga_produk')
            ->get();

        if ($cart) {
            $cartHtml = View::make('data.cart')->with(['cart' => $cart])->render();
            return response()->json(['cartHtml' => $cartHtml]);
        }

        return response()->json(['error' => 'Unable to fetch cart data'], 500);
    }

    public function index()
    {
        if(auth()->user()->alamat == null)
        {
            return view('homepage.profile');
        }else{
            $data = [
                'cart' => Carts::join('products', 'products.kode_produk', '=', 'carts.id_produk')
                ->where('id_pelanggan', auth()->user()->id)
                ->orderBy('id', 'DESC')
                ->select('carts.*', 'products.kategori_produk', 'products.photo', 'harga_produk')
                ->get(),
            ];

            return view('homepage.cart', $data);
        }
    }

    public function getTotal()
    {
        $total = DB::table('carts')
        ->where('id_pelanggan', auth()->user()->id)
        ->sum('harga');
        return response()->json(['total' => $total]);
    }

    public function store(Request $request)
    {
        if ($request->has('submit')) {
            $id_transaksi = 'TRX' . str_pad(Transactions::max('id') + 1, 2, '0', STR_PAD_LEFT) . sprintf('%03d', rand(1, 999));

            $transactions = [];

            foreach ($request->kode_produk as $key => $kode_produk) {
                $produk = Products::where('kode_produk', $kode_produk)->first();
                $harga  = ceil($produk->harga_produk * $produk->ppn/100) + $produk->harga_produk * $request->qty[$key];

                $transactions[] = [
                    'id_transaksi'    => $id_transaksi,
                    'id_produk'       => $produk->kode_produk,
                    'nama_produk'     => $produk->nama_produk,
                    'qty'             => $request->qty[$key], // Sesuaikan dengan input qty[]
                    'harga_produk'    => $harga,
                    'id_users'        => auth()->user()->id,
                    'nama_pelanggan'  => auth()->user()->nama,
                    'user_acc'        => null,
                    'tgl_transaksi'   => now(),
                    'close_transaksi' => null,
                    'status'          => 'pending',
                ];
            }

            Transactions::insert($transactions);

            // Menghapus item dari cart yang di-checkout
            Carts::whereIn('id_cart', $request->id_cart)->delete();

            toast('Transaksi berhasil dibuat', 'success');
            return redirect()->route('transaksi.detail', $id_transaksi);
        }
    }



    public function stock(Request $request, $id)
    {
        $cart   = Carts::where('id', $request->id)->first();
        $produk = Products::where('kode_produk', $cart->id_produk)->first();
        $ppn    = $produk->harga_produk * $produk->ppn/100;
        $total  = $produk->harga_produk + $ppn;

        if ($request->value == 'plus') {
            $qty = $cart ? ++$cart->qty : 1;
        } else {
            $qty = $cart ? max(0, --$cart->qty) : 1;
        }

        $harga = round($total * $qty);



        Carts::updateOrCreate(
            ['id' => $request->id],
            [
                'qty'   => $qty,
                'harga' => $harga,
            ]
        );

        return response()->json(['qty' => $qty]);
    }

    public function destroy($id)
    {
        $cart = Carts::find($id);

        if (!$cart) {
            abort(404);
        }

        if (!$cart)
        {
            toast('Hapus produk gagal dilakukan', 'error');
        }else{
            $cart->delete();
            toast('Hapus produk berhasil dilakukan!', 'success');
        }

        return redirect()->back();
    }

    public function hapusStock($id)
    {
        $cart = Carts::find($id);

        if (!$cart) {
            abort(404);
        }

        if (!$cart->delete()) {
            return response()->json(['success' => false, 'message' => 'Hapus produk gagal dilakukan'], 500);
        }

        return response()->json(['success' => true, 'message' => 'Hapus produk berhasil dilakukan', 'stock' => 0]);
    }

}
