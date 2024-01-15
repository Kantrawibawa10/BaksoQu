<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('homepage.profile');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'            => 'required',
            'username'        => 'required|unique:users,username,' . ($request['id'] ?? '') . ',id',
            'email'           => 'required|unique:users,email,' . ($request['id'] ?? '') . ',id',
            'profile'         => 'file|mimes:jpeg,bmp,png,gif|max:2000',
            'no_telepon'       => 'required',
            'alamat'          => 'required',
            'password'        => ($request->aksi == 'Update profile' ? 'nullable' : 'required'),
        ], [
            'nama.required'         => 'Nama tidak boleh kosong!',
            'email.unique'          => 'Data tidak boleh sama!',
            'username.required'     => 'Username tidak boleh kosong!',
            'username.unique'       => 'Data tidak boleh sama!',
            'profile.file'          => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'profile.mimes'         => 'Masukan Gambar sesuai format: jpeg, bmp, png, gif!',
            'profile.max'           => 'Ukuran Gambar maksimal 2000 KB!',
            'no_telepon.required'    => 'Form tidak boleh kosong!',
            'alamat.required'       => 'Form tidak boleh kosong!',
            'password.required'     => 'Form tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            toast('Update profile anda gagal dilakukan','error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $gambar = User::where('id', $request->id)->first();

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');

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

        $set = User::updateOrCreate(['id' => $request['id']], [
            'photo'             => $files,
            'nama'              => $request['nama'] == '' ? null : $request['nama'],
            'no_telpon'         => $request['no_telpon'] == '' ? null : $request['no_telpon'],
            'email'             => $request['email'] == '' ? null : $request['email'],
            'alamat'            => $request['alamat'] == '' ? null : $request['alamat'],
            'username'          => $request['username'] == '' ? null : $request['username'],
            'password'          => $password,
        ]);

        if ($set) {
            toast('Update profile anda berhasil dilakukan','success');
            return redirect()->back();
        }
    }
}
