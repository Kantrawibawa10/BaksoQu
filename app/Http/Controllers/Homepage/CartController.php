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
        $data = [
            'cart' => Carts::join('products', 'products.kode_produk', '=', 'carts.id_produk')
            ->where('id_pelanggan', auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->select('carts.*', 'products.kategori_produk', 'products.photo', 'harga_produk')
            ->get(),
        ];

        return view('homepage.cart', $data);
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
        //
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
