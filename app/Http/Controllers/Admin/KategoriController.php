<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Models\Kategori;

class KategoriController extends Controller
{
    public function _construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = [
            'kategori' => Kategori::all(),
        ];

        return view('admin.kategori', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori',
        ];

        return view('admin.form.kategori_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_produk' => 'required|unique:kategoris,kategori_produk,' . ($request['id'] ?? '') . ',id',
        ], [
            'kategori_produk.required' => 'Kategori tidak boleh kosong!',
            'kategori_produk.unique'   => 'Kategori telah tersedia!',
        ]);

        if ($validator->fails()) {
            Alert::warning('Oopss', $request->aksi.' gagal dilakukan');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $posts = Kategori::updateOrCreate(['id' => $request['id']], [
            'kategori_produk' => $request->kategori_produk,
        ]);

        if($posts)
        {
            Alert::success('Berhasil', $request->aksi.' berhasil dilakukan');
            if($request->aksi == "Tambah Kategori")
            {
                return redirect()->route('kategori.index');
            }else{
                return redirect()->back();
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' =>  'Update Kategori',
            'edit'  =>  Kategori::find($id)
        ];

        return view('admin.form.kategori_form', $data);
    }

    public function destroy($id)
    {
        //
    }
}
