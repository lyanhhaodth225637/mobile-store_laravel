<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\DonHangChiTiet;
use App\Models\User;
use App\Models\BinhLuan;
use Illuminate\Support\Facades\DB;

class QuanTriVienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getHome()
    {
        // 1. Tổng doanh thu
        $tong_doanhthu = DonHang::sum('tongtien');

        // 2. Tổng đơn hàng
        $tong_donhang = DonHang::count();

        // 3. Tổng sản phẩm đã bán
        $tong_spdaban = DonHangChiTiet::sum('soluong');

        // 4. Tổng người dùng
        $tong_nguoidung = User::count();

        // 5. Tổng đánh giá
        $tong_danhgia = BinhLuan::whereNotNull('danhgia')->count();

        // 6. Điểm đánh giá trung bình
        $tb_danhgia = BinhLuan::whereNotNull('danhgia')->avg('danhgia');

        // 7. Phân bố đánh giá theo sao
        $rating_counts = BinhLuan::whereNotNull('danhgia')
            ->select('danhgia', DB::raw('count(*) as total'))
            ->groupBy('danhgia')
            ->pluck('total', 'danhgia')
            ->toArray();

        // Đảm bảo có đủ 5 mức đánh giá (1-5 sao)
        $rating_data = [];
        for ($i = 1; $i <= 5; $i++) {
            $rating_data[] = $rating_counts[$i] ?? 0;
        }

        // Trả view với dữ liệu
        return view('admin.home', [
            'tong_doanhthu' => $tong_doanhthu,
            'tong_donhang' => $tong_donhang,
            'tong_spdaban' => $tong_spdaban,
            'tong_nguoidung' => $tong_nguoidung,
            'tong_danhgia' => $tong_danhgia,
            'tb_danhgia' => $tb_danhgia,
            'rating_data' => $rating_data,
        ]);
    }
}