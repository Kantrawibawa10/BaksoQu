<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;

class PelangganController extends Controller
{
    public function _construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $data = [
            'pelanggan' => User::where('role', 'Pelanggan')->get(),
        ];

        return view('admin.pelanggan', $data);
    }

    public function show($id)
    {
        $data = [
            'title'     =>  'Detail Pelanggan',
            'edit'      =>  User::find($id),
        ];

        return view('admin.form.form_pelanggan', $data);
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
            Alert::success('Berhasil', 'Pelanggan berhasil dihapus');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Pelanggan gagal dihapus');
            return redirect()->back();
        }
    }
}
