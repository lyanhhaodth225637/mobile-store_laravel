<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function getDanhSach()
    {
        $user = User::orderBy('role', 'asc')->orderBy('created_at', 'desc')->get();
        return view('admin.user.danhsach', compact('user'));
    }
    public function getDanhSach_NhanVien()
    {
        //$user = User::All();
        $user = User::where('role', '1')->get();
        return view('admin.user.danhsach', compact('user'));
    }
    public function getDanhSach_khachHang()
    {
        //$user = User::All();
        $user = User::where('role', '2')->get();
        return view('admin.user.danhsach', compact('user'));
    }
}
