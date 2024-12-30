<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index(){
        $user = User::all();
        return view('admin.dashboard', compact('user'));
    }
    public function produk(){
        return view('admin.produk.index');
    }
}
