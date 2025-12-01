<?php

namespace App\Http\Controllers;

use App\Models\DonHang;
use App\Models\TinhTrang;
use App\Models\DonHangChiTiet;
use Illuminate\Http\Request;

class DonHangController extends Controller
{
    public function getDanhSanh(){
        $tinhtrang = TinhTrang::all();
        $donhang = DonHang::latest()->get();
        $donhang_chitiet = DonHangChiTiet::all();
        return view('admin.donhang.danhsach', compact('donhang', 'tinhtrang','donhang_chitiet'));
    }
}
