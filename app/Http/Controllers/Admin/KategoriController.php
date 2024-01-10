<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Models\Kategori;
use App\Models\Products;

class KategoriController extends Controller
{
    public function _construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $data = [
            'kategori' => Kategori::all(),
        ];

        return view('admin.kategori', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori',
        ];

        return view('admin.form.form_kategori', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_produk' => 'required|unique:kategoris,kategori_produk,' . ($request['id'] ?? '') . ',id',
        ], [
            'kategori_produk.required' => 'Kategori tidak boleh kosong!',
            'kategori_produk.unique'   => 'Kategori telah tersedia!',
        ]);

        if ($validator->fails()) {
            toast($request->aksi.' gagal dilakukan','error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $produk     = Products::where('kategori_produk', '=', $request->kategori_produk)->get();

        $posts = Kategori::updateOrCreate(['id' => $request['id']], [
            'kategori_produk' => $request->kategori_produk,
        ]);

        if ($produk)
        {
            $kategoriProduk = $request->kategori_produk;

            Products::query()->update(['kategori_produk' => $kategoriProduk]);
        }

        if($posts)
        {
            toast($request->aksi.' berhasil dilakukan','success');
            if($request->aksi == "Tambah Kategori")
            {
                return redirect()->route('kategori.index');
            }else{
                return redirect()->back();
            }
        }
    }

    public function edit($id)
    {
        $data = [
            'title' =>  'Update Kategori',
            'edit'  =>  Kategori::find($id)
        ];

        return view('admin.form.form_kategori', $data);
    }

    public function destroy($id)
    {
        $kategori   = Kategori::find($id);
        $produk     = Products::first();

        if (!$kategori) {
            abort(404);
        }

        if ($produk->kategori_produk === $kategori->kategori_produk)
        {
            toast('Hapus kategori gagal dilakukan karena terdapat produk terkait!', 'error');
        }else{
            $kategori->delete();
            toast('Hapus kategori berhasil dilakukan!', 'success');
        }


        return redirect()->route('kategori.index'); // Gantilah dengan rute yang sesuai
    }
}
