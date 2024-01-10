<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Roles;

class UsersController extends Controller
{
    public function _construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $data = [
            'users' => User::where('users.id', '!=', auth()->user()->id)
            ->where('users.role', '!=', 'Pelanggan')
            ->orderBy('users.id', 'DESC')
            ->get(),
        ];

        return view('admin.users', $data);
    }


    public function create()
    {
        $data = [
            'title' =>  'Tambah users',
            'role'  =>  Roles::where('roles', '!=', 'Pelanggan')->get()
        ];

        return view('admin.form.form_users', $data);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo'             => ($request->aksi == 'Update users' ? 'nullable' : 'required|file|mimes:jpg,jpeg,bmp,png,gif|max:2000'),
            'nama'              => 'required',
            'no_telepon'        => 'required',
            'username'          => 'required',
            'password'          => ($request->aksi == 'Update users' ? 'nullable' : 'required'),
            'role'              => 'required',
            'alamat'            => 'required',
        ], [
            'photo.file'                => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'photo.mimes'               => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'photo.max'                 => 'Ukuran Gambar maksimal 2000 KB!',
            'photo.required'            => 'Gambar tidak boleh kosong',
            'nama.required'             => 'Nama tidak boleh kosong',
            'no_telepon.required'       => 'Telepon tidak boleh kosong',
            'username.required'         => 'Username tidak boleh kosong',
            'password.required'         => 'Password tidak boleh kosong',
            'role.required'             => 'Role tidak boleh kosong',
            'alamat.required'           => 'Alamat tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            toast($request->aksi.' gagal dilakukan','error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $gambar = User::where('id', $request->id)->first();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            if ($file->isValid()) {
                $files = $file->hashName();

                // File Handling
                if ($request->aksi == 'Tambah users' || $gambar->photo == null) {
                    $file->move(public_path('drive/users'), $files);
                } else {
                    // Delete old icon file
                    unlink(public_path('drive/users') . '/' . $gambar->photo);
                    $file->move(public_path('drive/users'), $files);
                }
            } else {
                // Handle invalid file
                if($request->aksi == "Tambah users"){
                    $files = null;
                }else{
                    $files = $gambar->photo ?? null;
                }
            }
        } else {
            if($request->aksi == "Tambah users"){
                $files = null;
            }else{
                $files = $gambar->photo ?? null;
            }
        }

        $pass = User::where('id', $request->id)->first();
        if($request->password == ""){
            $password = $pass->password;
        }else{
            $password = Hash::make($request['password']);
        }

        $lastid = $request['id'] ? $request['id'] : User::max('id') + 1;
        $store = User::updateOrCreate(['id' => $request['id']], [
            'id'                => $lastid,
            'photo'             => $files,
            'nama'              => $request['nama'] == '' ? null : $request['nama'],
            'no_telepon'        => $request['no_telepon'] == '' ? null : $request['no_telepon'],
            'harga_produk'      => $request['harga_produk'] == '' ? null : $request['harga_produk'],
            'alamat'            => $request['alamat'] == '' ? null : $request['alamat'],
            'email'             => $request['email'] == '' ? null : $request['email'],
            'username'          => $request['username'] == '' ? null : $request['username'],
            'password'          => $password,
            'role'              => $request['role'] == '' ? null : $request['role'],
        ]);

        if ($store) {
            toast($request->aksi.' berhasil dilakukan','success');
            if($request->aksi == "Tambah users")
            {
                return redirect()->route('users.index');
            }else{
                return redirect()->back();
            }
        }
    }

    public function show($id)
    {
        $data = [
            'title'     =>  'Detail Users',
            'edit'      =>  User::find($id),
        ];

        return view('admin.form.detail_users', $data);
    }


    public function edit($id)
    {
        $data = [
            'title'     =>  'Update users',
            'role'      =>  Roles::where('roles', '!=', 'Pelanggan')->get(),
            'edit'      =>  User::find($id),
        ];

        return view('admin.form.form_users', $data);
    }


    public function destroy($id)
    {
        $cek = User::where('id', $id)->first();

        if($cek)
        {
            if($cek->photo == null)
            {

            }else{
                $filePath = public_path('drive/users' . '/' . $cek->photo);
                if (file_exists($filePath)) {
                    unlink($filePath);
                } else {
                    // Handle the case where the file doesn't exist if necessary
                }
            }
            User::where('id', $id)->delete();
            Alert::success('Berhasil', 'Users berhasil dihapus');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Users gagal dihapus');
            return redirect()->back();
        }
    }
}
