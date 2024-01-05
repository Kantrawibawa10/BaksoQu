<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\Kategori;

class ProdukController extends Controller
{
    public function _construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $data = [
            'produk' => Products::all(),
        ];

        return view('admin.produk', $data);
    }

    public function create()
    {
        $data = [
            'title'     =>  'Tambah Produk',
            'kategori'  =>  Kategori::all()
        ];

        return view('admin.form.form_produk', $data);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
