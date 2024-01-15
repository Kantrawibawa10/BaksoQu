<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'        => 'required|unique:users,username,' . ($request['id'] ?? '') . ',id',
            'email'           => 'required|unique:users,email,' . ($request['id'] ?? '') . ',id',
            'no_telepon'       => 'required',
            'password'        => ($request->aksi == 'Update users' ? 'nullable' : 'required'),
        ], [
            'nama.required'         => 'Nama tidak boleh kosong!',
            'email.unique'          => 'Data tidak boleh sama!',
            'username.required'     => 'Username tidak boleh kosong!',
            'username.unique'       => 'Data tidak boleh sama!',
            'no_telepon.required'    => 'Form tidak boleh kosong!',
            'password.required'     => 'Form tidak boleh kosong!',
            'email.required'        => 'Form tidak boleh kosong!',
        ]);

        if ($validator->fails()) {
            toast('Registrasi anda gagal dilakukan','error');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $id = User::max('id') + 1;

        $set = User::create([
            'id'                => $id,
            'nama'              => $request['nama'] == '' ? null : $request['nama'],
            'no_telepon'        => $request['no_telepon'] == '' ? null : $request['no_telepon'],
            'email'             => $request['email'] == '' ? null : $request['email'],
            'username'          => $request['username'] == '' ? null : $request['username'],
            'password'          => Hash::make($request['password']) == '' ? '' : Hash::make($request['password']),
            'role'              => 'Pelanggan',
        ]);

        if ($set) {
            auth()->attempt($request->only('username', 'password'));
            toast('Registrasi anda berhasil dilakukan','success');
            return redirect()->route('home');
        }
    }
}
