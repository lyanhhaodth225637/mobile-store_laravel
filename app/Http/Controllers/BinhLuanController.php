<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BinhLuan;

class BinhLuanController extends Controller
{
    public function getDSBinhLuan()
    {
        // Lấy tất cả bình luận, sắp xếp theo rating giảm dần
        $binhluan = BinhLuan::orderBy('danhgia', 'desc')->get();

        // Trả về view và truyền dữ liệu
        return view('admin.binhluan.danhsach', compact('binhluan'));
    }

    public function getLoc(Request $request)
    {
        // Lấy giá trị số sao từ form
        $sosao = $request->input('sosao'); // name="kho" trong select

        // Nếu có chọn số sao, lọc theo rating, ngược lại lấy tất cả
        if ($sosao) {
            $binhluan = BinhLuan::where('danhgia', $sosao)
                ->orderBy('danhgia', 'desc')
                ->get();
        } else {
            $binhluan = BinhLuan::orderBy('danhgia', 'desc')->get();
        }

        // Trả view và truyền dữ liệu
        return view('admin.binhluan.danhsach', compact('binhluan'));
    }
}
