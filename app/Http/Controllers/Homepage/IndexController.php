<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use View;
use DB;

use App\Models\Products;
use App\Models\Kategori;
use App\Models\Carts;

class IndexController extends Controller
{

    public function index()
    {
        $produk = Products::where('stock', '!=', 0)->get();
        $kategori = Kategori::all();

        $minprice = Products::min(DB::raw('harga_produk * ppn/100 + harga_produk'));
        $maxprice = Products::max(DB::raw('harga_produk * ppn/100 + harga_produk'));

        return view('homepage.index', compact('produk', 'kategori', 'minprice', 'maxprice'));
    }

    public function kontak()
    {
        return view('homepage.kontak');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $selectedCategories = $request->input('categories', []);
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');

        $produkQuery = Products::query();

        if ($searchTerm) {
            $produkQuery->where(function ($query) use ($searchTerm) {
                $query->where('nama_produk', 'like', '%' . $searchTerm . '%')
                    ->orWhere('kategori_produk', 'like', '%' . $searchTerm . '%');
            });
        }

        if (!empty($selectedCategories) && !in_array('all', $selectedCategories)) {
            $produkQuery->whereIn('kategori_produk', $selectedCategories);
        }

        if ($minPrice && $maxPrice) {
            $produkQuery->whereBetween(DB::raw('(harga_produk * ppn/100) + harga_produk'), [$minPrice, $maxPrice]);
        }

        $produk = $produkQuery->get();

        $minprice = $produkQuery->min(DB::raw('(harga_produk * ppn/100) + harga_produk'));
        $maxprice = $produkQuery->max(DB::raw('(harga_produk * ppn/100) + harga_produk'));

        return view('data.produk', compact('produk', 'minprice', 'maxprice'));
    }

    public function show($id)
    {

        $detail = Products::find($id);
        if ($detail) {
            $produk = Products::where('stock', '!=', 0)
                ->where('kategori_produk', $detail->kategori_produk)
                ->where('id', '!=', $id)
                ->inRandomOrder()
                ->limit(4)
                ->get();
        }


        return view('homepage.detail', compact('detail', 'produk'));
    }

    public function postCart(Request $request)
    {
        $id = $request['id'] ? $request['id'] : Products::max('id') + 1;
        $idCart = 'chart' . str_pad($id, 2, '0', STR_PAD_LEFT) . sprintf('%03d', rand(1, 999));

        $produk = Products::where('kode_produk', $request->kode_produk)->first();
        $harga  = ceil($produk->harga_produk * $produk->ppn/100) + $produk->harga_produk * $request->qty;

        $post = Carts::create([
            'id'              => $id,
            'id_cart'        => $idCart,
            'id_produk'       => $produk->kode_produk,
            'nama_produk'     => $produk->nama_produk,
            'qty'             => $request->qty,
            'harga'           => $harga,
            'id_pelanggan'    => auth()->user()->id,
            'nama_pelanggan'  => auth()->user()->nama,
        ]);

        if ($post) {
            toast('Produk berhasil dimasukan kekeranjang','success');
            return redirect()->back();
        }
    }
}
