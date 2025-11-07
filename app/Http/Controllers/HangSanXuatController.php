<?php

namespace App\Http\Controllers;

use App\Models\HangSanXuat;
use Illuminate\Http\Request;

class HangSanXuatController extends Controller
{
     public function getDanhSach()
    {
        $hangsanxuat = HangSanXuat::orderBy('tenhang', 'asc')->get();
        return view('admin.hangsanxuat.danhsach', compact('hangsanxuat'));
    }
}
