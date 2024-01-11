<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

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
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'photo'             => ($request->aksi == 'Update Produk' ? 'nullable' : 'required|file|max:2000'),
            'nama_produk'       => 'required',
            'kategori_produk'   => 'required',
            'harga_produk'      => 'required',
            'ppn'               => 'required',
            'deskripsi'         => 'required',
            'stock'             => 'required',
        ], [
            'photo.file'                => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'photo.max'                 => 'Ukuran Gambar maksimal 2000 KB!',
            'photo.required'            => 'Gambar tidak boleh kosong',
            'nama_produk.required'      => 'Nama produk tidak boleh kosong',
            'kategori_produk.required'  => 'Kategori produk tidak boleh kosong',
            'harga_produk.required'     => 'Harga produk tidak boleh kosong',
            'ppn.required'              => 'PPN tidak boleh kosong',
            'deskripsi.required'        => 'Input tidak boleh kosong',
            'stock.required'            => 'Input tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            toast($request->aksi.' gagal dilakukan','error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $gambar = Products::where('id', $request->id)->first();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            if ($file->isValid()) {
                $files = $file->hashName();

                // File Handling
                if ($request->aksi == 'Tambah Produk' || $gambar->photo == null) {
                    $file->move(public_path('drive/produk'), $files);
                } else {
                    // Delete old icon file
                    unlink(public_path('drive/produk') . '/' . $gambar->photo);
                    $file->move(public_path('drive/produk'), $files);
                }
            } else {
                // Handle invalid file
                if($request->aksi == "Tambah Produk"){
                    $files = null;
                }else{
                    $files = $gambar->photo ?? null;
                }
            }
        } else {
            if($request->aksi == "Tambah Produk"){
                $files = null;
            }else{
                $files = $gambar->photo ?? null;
            }
        }

        if($request->stock == 0){
            $status = 'tidak tersedia';
        }else{
            $status = 'tersedia';
        }

        $lastid = $request['id'] ? $request['id'] : Products::max('id') + 1;
        $kode = 'PRD' . str_pad($lastid, 2, '0', STR_PAD_LEFT) . sprintf('%03d', rand(1, 999));
        $store = Products::updateOrCreate(['id' => $request['id']], [
            'id'                => $lastid,
            'kode_produk'       => $kode,
            'photo'             => $files,
            'kategori_produk'   => $request['kategori_produk'] == '' ? null : $request['kategori_produk'],
            'nama_produk'       => $request['nama_produk'] == '' ? null : $request['nama_produk'],
            'harga_produk'      => $request['harga_produk'] == '' ? null : $request['harga_produk'],
            'ppn'               => $request['ppn'] == '' ? null : $request['ppn'],
            'stock'             => $request['stock'] == '' ? null : $request['stock'],
            'deskripsi'         => $request['deskripsi'] == '' ? null : $request['deskripsi'],
            'status'            => $status,
        ]);

        if ($store) {
            toast($request->aksi.' berhasil dilakukan','success');
            if($request->aksi == "Tambah Produk")
            {
                return redirect()->route('produk.index');
            }else{
                return redirect()->back();
            }
        }
    }

    public function edit($id)
    {
        $data = [
            'title'     =>  'Update Produk',
            'kategori'  =>  Kategori::all(),
            'edit'      =>  Products::find($id),
        ];

        return view('admin.form.form_produk', $data);
    }

    public function destroy($id)
    {
        $cek = Products::where('id', $id)->first();

        if($cek)
        {
            if($cek->photo == null)
            {

            }else{
                $filePath = public_path('drive/produk' . '/' . $cek->photo);
                if (file_exists($filePath)) {
                    unlink($filePath);
                } else {
                    // Handle the case where the file doesn't exist if necessary
                }
            }
            Products::where('id', $id)->delete();
            Alert::success('Berhasil', 'Katalog bakso berhasil dihapus');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Katalog bakso gagal dihapus');
            return redirect()->back();
        }
    }
}
