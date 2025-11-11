<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function getHome()
    {
        // Bổ sung code tại đây
        return view('frontend.home');
    }

    public function getSanPham($tenloai_slug = '')
    {
        // Bổ sung code tại đây
        return view('frontend.sanpham');
    }

    public function getSanPham_ChiTiet($tenloai_slug = '', $tensanpham_slug = '')
    {
        // Bổ sung code tại đây
        return view('frontend.sanpham_chitiet');
    }

    public function getBaiViet($tenchude_slug = '')
    {
        // Bổ sung code tại đây
        return view('frontend.baiviet');
    }

    public function getBaiViet_ChiTiet($tenchude_slug = '', $tieude_slug = '')
    {
        // Bổ sung code tại đây
        return view('frontend.baiviet_chitiet');
    }
    public function getGioHang()
    {
        // Bổ sung code tại đây
        return view('frontend.giohang');
    }

    public function getGioHang_Them($tensanpham_slug = '')
    {
        // Bổ sung code tại đây
        return redirect()->route('frontend.home');
    }

    public function getGioHang_Xoa($row_id)
    {
        // Bổ sung code tại đây
        return redirect()->route('frontend.giohang');
    }

    public function getGioHang_Giam($row_id)
    {
        // Bổ sung code tại đây
        return redirect()->route('frontend.giohang');
    }

    public function getGioHang_Tang($row_id)
    {
        // Bổ sung code tại đây
        return redirect()->route('frontend.giohang');
    }

    public function getTuyenDung()
    {
        return view('frontend.tuyendung');
    }

    public function getLienHe()
    {
        return view('frontend.lienhe');
    }

    // Trang đăng ký dành cho khách hàng
    public function getDangKy()
    {
        return view('user.dangky');
    }

    // Trang đăng nhập dành cho khách hàng
    public function getDangNhap()
    {
        return view('user.dangnhap');
    }

}
