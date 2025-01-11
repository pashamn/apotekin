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
    public function users(){
        return view('admin.users.index');
    }
    public function order(){
        return view('admin.order.index');
    }
    public function categories(){
        return view('admin.categories.index');
    }
    public function analis(){
        return view('admin.analis.index');
    }
    public function seting(){
        return view('admin.seting.index');
    }
}
