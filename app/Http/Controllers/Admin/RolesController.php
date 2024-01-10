<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

use App\Models\Roles;

class RolesController extends Controller
{
    public function _construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $data = [
            'roles' => Roles::where('roles', '!=', 'Pelanggan')->get(),
        ];

        return view('admin.roles', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
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
