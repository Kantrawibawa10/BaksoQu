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

class IndexController extends Controller
{

    public function index()
    {
        $data  = [
            'produk'    => Products::where('stock', '!=', 0)->paginate(2),
            'kategori'  => Kategori::all(),
        ];

        $minprice = Products::min(DB::raw('harga_produk * ppn/100 + harga_produk'));
        $maxprice = Products::max(DB::raw('harga_produk * ppn/100 + harga_produk'));

        return view('homepage.index', compact('minprice', 'maxprice'), $data);
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

        // Filter by search term
        if ($searchTerm) {
            $produkQuery->where(function ($query) use ($searchTerm) {
                $query->where('nama_produk', 'like', '%' . $searchTerm . '%')
                    ->orWhere('kategori_produk', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by selected categories
        if (!empty($selectedCategories) && !in_array('all', $selectedCategories)) {
            $produkQuery->whereIn('kategori_produk', $selectedCategories);
        }

        // Filter by price range
        if ($minPrice && $maxPrice) {
            $produkQuery->whereBetween(DB::raw('(harga_produk * ppn/100) + harga_produk'), [$minPrice, $maxPrice]);
        }

        // Fetch the paginated results
        $produkPerPage = 2; // Sesuaikan dengan jumlah produk yang ingin ditampilkan per halaman
        $produk = $produkQuery->paginate($produkPerPage);

        $minprice = $produkQuery->min(DB::raw('(harga_produk * ppn/100) + harga_produk'));
        $maxprice = $produkQuery->max(DB::raw('(harga_produk * ppn/100) + harga_produk'));

        return view('data.produk', compact('produk', 'minprice', 'maxprice'));
    }
}
