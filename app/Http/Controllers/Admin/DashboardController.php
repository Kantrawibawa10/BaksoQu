<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function _construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $data = [
            'order'         => Transactions::where('status', 'proses')->get(),
            'penghasilan'   => Transactions::where('status', 'selesai')->get(),

        ];

        return view('admin.dashboard', $data);
    }
}
