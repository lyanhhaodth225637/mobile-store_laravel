<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiSanPham;
use App\Models\SanPham;
use App\Models\HangSanXuat;
use App\Models\BinhLuan;
use App\Models\BinhLuanLike;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class HomeController extends Controller
{

    public function getHome()
    {
        $hangsanxuat = HangSanXuat::all();

        $loaisanpham = LoaiSanPham::with([
            'SanPham' => function ($query) {
                $query->latest()->take(8);
            }
        ])->get();

        foreach ($loaisanpham as $loai) {
            foreach ($loai->SanPham as $sp) {
                $sp->soBinhLuan = BinhLuan::where('sanpham_id', $sp->id)->count();
                $sp->trungBinhSao = round(
                    BinhLuan::where('sanpham_id', $sp->id)->avg('danhgia') ?? 0,
                    1
                );
            }
        }

        return view('frontend.home', compact('loaisanpham', 'hangsanxuat'));
    }


    public function getSanPham($tenloai_slug = '')
    {
        //hãng sản xuất
        $hangsanxuat = HangSanXuat::all();
        // tìm loại sản phẩm qua slug
        $loaisanpham = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->firstOrFail();
        // lấy danh sách sản phẩm thuộc loại đó
        $sanpham = SanPham::where('loaisanpham_id', $loaisanpham->id)->paginate(15);
        return view('frontend.sanpham', compact('sanpham', 'loaisanpham', 'hangsanxuat'));
    }

    //viết ở đây
    public function getSanPham_ChiTiet($tenloai_slug = '', $tensanpham_slug = '')
    {
        // Lấy sản phẩm hiện tại
        $sanpham = SanPham::where('tensanpham_slug', $tensanpham_slug)->firstOrFail();

        // Lấy bình luận
        $soBinhLuan = BinhLuan::where('sanpham_id', $sanpham->id)->count();
        $trungBinhSao = round(BinhLuan::where('sanpham_id', $sanpham->id)->avg('danhgia') ?? 0, 1);
        $binhluans = BinhLuan::with(['user', 'replies.user'])
            ->where('sanpham_id', $sanpham->id)
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->get();

        // **Lấy sản phẩm random để hiển thị "Sản phẩm yêu thích"**
        $sanPhamYeuThich = SanPham::inRandomOrder()->limit(8)->get();

        // Trả về view
        return view('frontend.sanpham_chitiet', compact(
            'sanpham',
            'binhluans',
            'soBinhLuan',
            'trungBinhSao',
            'sanPhamYeuThich' // truyền biến vào view
        ));
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
        if (Cart::count() > 0) {
            return view('frontend.giohang');
        }
        return view('frontend.giohangrong');
    }

    public function postGioHang_Them(Request $request)
    {
        $sanpham = SanPham::where('tensanpham_slug', $request->tensanpham_slug)->firstOrFail();

        $gia = $sanpham->khuyenmai > 0 ? $sanpham->gia_khuyenmai : $sanpham->gia;

        Cart::add([
            'id' => $sanpham->id,
            'name' => $sanpham->tensanpham,
            'qty' => 1,
            'price' => $gia,
            'weight' => 0,
            'options' => [
                'hinhanh' => $sanpham->hinhanh,
                'gia' => $sanpham->gia,
                'khuyenmai' => $sanpham->khuyenmai ?? 0,
                'gia_khuyenmai' => $sanpham->gia_khuyenmai ?? $sanpham->gia,
            ]
        ]);

        return response()->json([
            'success' => true,
            'count' => Cart::count(),
            'total' => Cart::total(),
            'message' => 'Đã thêm "' . $sanpham->tensanpham . '" vào giỏ hàng!'
        ]);
    }

    public function getGioHang_Xoa($row_id)
    {
        Cart::remove($row_id);
        return redirect()->back();
    }

    public function getGioHang_Giam($row_id)
    {
        $row = Cart::get($row_id);
        if ($row->qty > 1) {
            Cart::update($row_id, $row->qty - 1);
        }
        return redirect()->route('frontend.giohang');
    }

    public function getGioHang_Tang($row_id)
    {
        $row = Cart::get($row_id);
        if ($row->qty < 10) {
            Cart::update($row_id, $row->qty + 1);
        }
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


    //lọc sản phẩm 
    public function getLoc(Request $request, $tenloai_slug)
    {
        $loaisanpham = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->firstOrFail();
        $hangsanxuat = HangSanXuat::all();
        $query = SanPham::where('loaisanpham_id', $loaisanpham->id);

        // Lọc theo hãng sản xuất
        if ($request->filled('hangsanxuat')) {
            $query->where('hangsanxuat_id', $request->hangsanxuat);
        }

        // Lọc theo giá (RADIO BUTTON - chỉ 1 giá trị)
        if ($request->filled('mucgia')) {
            $range = $request->mucgia;

            // Tách min và max từ chuỗi "0-5000000" hoặc "20000000-"
            if (strpos($range, '-') !== false) {
                [$min, $max] = explode('-', $range);

                if ($max == '') {
                    // Trên 20 triệu (format: "20000000-")
                    $query->where('gia', '>=', (int) $min);
                } else {
                    // Khoảng giá cụ thể (format: "5000000-10000000")
                    $query->whereBetween('gia', [(int) $min, (int) $max]);
                }
            }
        }

        // Lọc theo trạng thái (RADIO BUTTON - chỉ 1 giá trị)
        if ($request->filled('trangthai')) {
            $query->where('trangthai', $request->trangthai);
        }

        // Lọc theo khuyến mãi (RADIO BUTTON - chỉ 1 giá trị)
        if ($request->filled('khuyenmai')) {
            $khuyenmaiValue = $request->khuyenmai;

            if ($khuyenmaiValue == '1') {
                // Có khuyến mãi (bất kỳ)
                $query->whereNotNull('khuyenmai')->where('khuyenmai', '>', 0);
            } else {
                // Giảm X% trở lên (10, 20, 30)
                $query->where('khuyenmai', '>=', (int) $khuyenmaiValue);
            }
        }

        // Sắp xếp
        if ($request->filled('sapxep')) {
            switch ($request->sapxep) {
                case 'price-low':
                    $query->orderBy('gia', 'asc');
                    break;

                case 'price-high':
                    $query->orderBy('gia', 'desc');
                    break;

                case 'popular':
                    $query->orderBy('luotxem', 'desc');
                    break;

                case 'rating':
                    $query->orderBy('danhgia', 'desc');
                    break;

                default: // newest
                    $query->orderBy('id', 'desc');
            }
        } else {
            // Mặc định sắp xếp theo mới nhất
            $query->orderBy('id', 'desc');
        }

        // Lấy sản phẩm với phân trang và giữ query string
        $sanpham = $query->paginate(15)->withQueryString();

        return view('frontend.sanpham', [
            'sanpham' => $sanpham,
            'hangsanxuat' => $hangsanxuat,
            'loaisanpham' => $loaisanpham,
            'request' => $request,
        ]);
    }

    //
    public function getTraGop()
    {
        return view('frontend.tragop');
    }



    // Chuyển tới màn hình Đăng nhập bằng Google
    public function getGoogleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    // Xử lý phản hồi sau khi đăng nhập thành công ở Google
    public function getGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')
                ->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))
                ->stateless()
                ->user();
        } catch (Exception $e) {
            return redirect()->route('user.dangnhap')->with('warning', 'Lỗi xác thực. Xin vui lòng thử lại!');
        }

        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            // Nếu người dùng đã tồn tại thì đăng nhập
            Auth::login($existingUser, true);
            return redirect()->route('user.home');
        } else {
            // Nếu chưa tồn tại người dùng thì thêm mới
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'username' => Str::before($user->email, '@'),
                'password' => Hash::make('12345678'), // Gán mật khẩu tự do
            ]);

            // Sau đó đăng nhập
            Auth::login($newUser, true);
            return redirect()->route('user.home');
        }
    }


    public function getTimKiem(Request $request)
    {
        $keyword = $request->input('keyword');

        $sanpham = SanPham::with('loaisanpham')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('tensanpham', 'like', '%' . $keyword . '%');
            })
            ->paginate(12)
            ->withQueryString(); // giữ query khi phân trang

        return view('frontend.timkiem', compact('sanpham', 'keyword'));
    }

    public function getLocTK(Request $request, $tenloai_slug)
    {
        $loaisanpham = LoaiSanPham::where('tenloai_slug', $tenloai_slug)->firstOrFail();
        $hangsanxuat = HangSanXuat::all();
        $query = SanPham::where('loaisanpham_id', $loaisanpham->id);

        // Validation
        $validated = $request->validate([
            'hangsanxuat' => 'nullable|exists:hangsanxuat,id',
            'mucgia' => 'nullable|string|regex:/^\d+-\d*$/',
            'trangthai' => 'nullable|in:0,1,2',
            'khuyenmai' => 'nullable|in:1,10,20,30',
            'sapxep' => 'nullable|in:price-low,price-high,popular,rating',
        ]);

        // Lọc theo hãng sản xuất
        if ($request->filled('hangsanxuat')) {
            $query->where('hangsanxuat_id', $request->hangsanxuat);
        }

        // Lọc theo giá (RADIO BUTTON - chỉ 1 giá trị)
        if ($request->filled('mucgia')) {
            $range = $request->mucgia;

            // Tách min và max từ chuỗi "0-5000000" hoặc "20000000-"
            if (strpos($range, '-') !== false) {
                [$min, $max] = explode('-', $range);

                if ($max == '') {
                    // Trên 20 triệu (format: "20000000-")
                    $query->where('gia', '>=', (int) $min);
                } else {
                    // Khoảng giá cụ thể (format: "5000000-10000000")
                    $query->whereBetween('gia', [(int) $min, (int) $max]);
                }
            }
        }

        // Lọc theo trạng thái (RADIO BUTTON - chỉ 1 giá trị)
        if ($request->filled('trangthai')) {
            $query->where('trangthai', $request->trangthai);
        }

        // Lọc theo khuyến mãi (RADIO BUTTON - chỉ 1 giá trị)
        if ($request->filled('khuyenmai')) {
            $khuyenmaiValue = $request->khuyenmai;

            if ($khuyenmaiValue == '1') {
                // Có khuyến mãi (bất kỳ)
                $query->where('khuyenmai', '>', 0);
            } else {
                // Giảm X% trở lên (10, 20, 30)
                $query->where('khuyenmai', '>=', (int) $khuyenmaiValue);
            }
        }

        // Sắp xếp
        if ($request->filled('sapxep')) {
            switch ($request->sapxep) {
                case 'price-low':
                    $query->orderBy('gia', 'asc');
                    break;

                case 'price-high':
                    $query->orderBy('gia', 'desc');
                    break;

                case 'popular':
                    $query->orderBy('luotxem', 'desc');
                    break;

                case 'rating':
                    $query->leftJoin('danhgia as dg', 'sanpham.id', '=', 'dg.sanpham_id')
                        ->select('sanpham.*', DB::raw('AVG(dg.sosao) as avg_rating'))
                        ->groupBy('sanpham.id')
                        ->orderBy('avg_rating', 'desc');
                    break;
            }
        } else {
            // Mặc định sắp xếp theo mới nhất
            $query->orderBy('id', 'desc');
        }

        // Lấy sản phẩm với phân trang và giữ query string
        $sanpham = $query->paginate(15)->withQueryString();

        return view('frontend.timkiem', [
            'sanpham' => $sanpham,
            'hangsanxuat' => $hangsanxuat,
            'loaisanpham' => $loaisanpham,
            'request' => $request,
        ]);
    }


}
