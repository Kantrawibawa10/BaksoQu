<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class LoginController extends Controller
{
    public function _construct()
    {
        $this->middleware("guest");
    }

    public function index()
    {
        return view('auth.login');
    }

    public function posts(Request $request)
    {
        $cek = User::join('roles', 'roles.roles', '=', 'users.role')
        ->where('username', '=', $request->username)->first();

        $validator = Validator::make($request->all(), [
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ], [
            'required' => 'Username tidak boleh kosong.',
            'exists' => 'Username tidak ditemukan',
        ]);

        $validator->after(function ($validator) use ($request) {

            $user = User::where('username', $request->input('username'))->first();

            if (!$user || !password_verify($request->input('password'), $user->password)) {
                $validator->errors()->add('password', 'password salah');
            }
        });

        if ($validator->fails()) {
            toast('Username atau password yang anda masukan salah','warning');
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

        }

        if ($cek && !auth()->attempt($request->only('username', 'password'), $request->remember)) {
            toast('Username atau password yang anda masukan salah','warning');
            return back()->with('gagal', 'invalide login detailes');

        } elseif ($cek) {
            toast('Horee berhasil login, selamat datang di baksoqu','success');
            if($cek->nama_role == 'Pelanggan'){
                toast('Horee berhasil login, selamat datang di baksoqu','success');
                return redirect()->route('home');
            }else{
                toast('Horee berhasil login, selamat datang di portal admin baksoqu','success');
                return redirect('dashboard');
            }

        } else {
            toast('Sepertinya ada kesalahan saat login','danger');
            return redirect()->back();

        }
    }
}
