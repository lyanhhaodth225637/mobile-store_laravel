<?php
namespace App\Http\Controllers;
use App\Models\DonHang;
use App\Models\BinhLuan;
use App\Models\BinhLuanLike;
use App\Models\DonHangChiTiet;
use App\Models\SanPham;
use App\Models\Voucher;
use App\Models\UserVoucher;
use App\Models\MspayTransaction;
use App\Models\HopDongTraGop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\DatHangThanhCongEmail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Gloudemans\Shoppingcart\Facades\Cart;
use PhpParser\Node\Expr\Cast\Double;
use Illuminate\Support\Facades\Storage;

class KhachHangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getHome()
    {
        // tranghoso
        if (Auth::check()) {
            $user = User::find(Auth::user()->id);
            return view('user.home', compact('user'));
        } else
            return redirect()->route('user.dangnhap');
    }

    public function getDatHang()
    {
        if (Auth::check()) {
            // Lấy voucher hợp lệ của user
            $userVouchers = UserVoucher::with('voucher') // load quan hệ voucher
                ->where('user_id', Auth::id())
                ->whereHas('voucher', function ($q) {
                    $q->where('trang_thai', 1)
                        ->where('so_luong', '>', 0)
                        ->whereDate('het_han', '>=', Carbon::today());
                })
                ->get();

            return view('user.dathang', compact('userVouchers'));
        } else {
            return view('user.dangnhap');
        }
    }

    // public function postDatHang(Request $request)
    // {
    //     //kiểm tra đầu vào
    //     $this->validate($request, [
    //         'diachi' => ['required', 'string', 'max:255'],
    //         'sodienthoai' => ['required', 'string', 'size:10']
    //     ]);

    //     //lưu vào hóa đơn
    //     $dh = new DonHang();
    //     $dh->user_id = Auth::user()->id;
    //     $dh->tinhtrang_id = 1;//mặc định "chờ xác nhận"
    //     $dh->diachi = $request->diachi;
    //     $dh->sodienthoai = $request->sodienthoai;

    //     $tongtien = (Double) str_replace('.', '', Cart::total());
    //     $dh->tongtien = $tongtien;

    //     $VAT = (Double) str_replace('.', '', Cart::tax());
    //     $dh->VAT = $VAT;

    //     $dh->save();

    //     //lưu vào chi tiết hóa đơn
    //     foreach (Cart::content() as $value) {
    //         $ctdh = new DonHangChiTiet();
    //         $ctdh->donhang_id = $dh->id;
    //         $ctdh->sanpham_id = $value->id;
    //         $ctdh->soluong = $value->qty;
    //         $ctdh->dongia = $value->price;
    //         $ctdh->thanhtien = $value->qty * $value->price;
    //         $ctdh->hinhanh = $value->options->hinhanh;
    //         $ctdh->gia = $value->options->gia;
    //         $ctdh->khuyenmai = $value->options->khuyenmai;
    //         $ctdh->gia_khuyenmai = $value->options->gia_khuyenmai;

    //         $ctdh->save();
    //     }

    //     // Cộng điểm khi mua hàng (giả sử 1% tổng tiền làm điểm, và User có trường 'diem')
    //     $user = Auth::user();
    //     $diem = floor($tongtien / 10000); // Ví dụ: 1 điểm cho mỗi 100 VNĐ, điều chỉnh theo logic của bạn
    //     $user->points += $diem; // Giả sử trường điểm tên 'diem'
    //     $user->save();
    //     return redirect()->route('user.dathangthanhcong');
    // }


    // public function postDatHang(Request $request)
    // {
    //     // Kiểm tra đầu vào
    //     $this->validate($request, [
    //         'diachi' => ['required', 'string', 'max:255'],
    //         'sodienthoai' => ['required', 'string', 'size:10']
    //     ]);

    //     // Lưu vào hóa đơn
    //     $dh = new DonHang();
    //     $dh->user_id = Auth::user()->id;
    //     $dh->tinhtrang_id = 1; // mặc định "chờ xác nhận"
    //     $dh->diachi = $request->diachi;
    //     $dh->sodienthoai = $request->sodienthoai;

    //     $tongtien = (double) str_replace('.', '', Cart::total());
    //     $dh->tongtien = $tongtien;

    //     $VAT = (double) str_replace('.', '', Cart::tax());
    //     $dh->VAT = $VAT;

    //     $dh->save();

    //     // Lưu vào chi tiết hóa đơn và cập nhật số lượng đã bán
    //     foreach (Cart::content() as $value) {
    //         $ctdh = new DonHangChiTiet();
    //         $ctdh->donhang_id = $dh->id;
    //         $ctdh->sanpham_id = $value->id;
    //         $ctdh->soluong = $value->qty;
    //         $ctdh->dongia = $value->price;
    //         $ctdh->thanhtien = $value->qty * $value->price;
    //         $ctdh->hinhanh = $value->options->hinhanh;
    //         $ctdh->gia = $value->options->gia;
    //         $ctdh->khuyenmai = $value->options->khuyenmai;
    //         $ctdh->gia_khuyenmai = $value->options->gia_khuyenmai;
    //         $ctdh->save();

    //         // Cập nhật số lượng đã bán cho sản phẩm
    //         $sanpham = SanPham::find($value->id);
    //         if ($sanpham->soluong < $value->qty) {
    //             //thông đệpj
    //         }

    //         if ($sanpham) {
    //             $sanpham->daban += $value->qty; // giả sử cột 'daban' trong bảng sanpham
    //             $sanpham->soluong -= $value->qty;
    //             if ($sanpham->soluong == 0) {
    //                 $sanpham->trangthai = 0;
    //             }
    //             $sanpham->save();
    //         }
    //     }

    //     // Cộng điểm khi mua hàng (1 điểm cho mỗi 10.000 VNĐ)
    //     $user = Auth::user();
    //     $diem = floor($tongtien / 10000);
    //     $user->points += $diem; // giả sử trường điểm tên 'points'
    //     $user->save();

    //     // Xóa giỏ hàng sau khi đặt hàng
    //     Cart::destroy();

    //     return redirect()->route('user.dathangthanhcong')->with('success', 'Đặt hàng thành công!');
    // }
    public function postDatHang(Request $request)
    {
        // 1. Kiểm tra đầu vào
        $this->validate($request, [
            'diachi' => ['required', 'string', 'max:255'],
            'sodienthoai' => ['required', 'string', 'size:10']
        ]);

        // 2. Lấy voucher từ session (nếu có)
        $voucher = session('voucher');

        // 3. Tính tổng tiền giỏ hàng
        $tongtien = (double) str_replace('.', '', Cart::total());
        $VAT = (double) str_replace('.', '', Cart::tax());

        if ($voucher) {
            $tongtien -= $voucher->gia_tri; // trừ tiền voucher
            $tongtien = max($tongtien, 0); // đảm bảo >= 0
        }

        // 4. Lưu hóa đơn
        $dh = new DonHang();
        $dh->user_id = Auth::user()->id;
        $dh->tinhtrang_id = 1; // mặc định "chờ xác nhận"
        $dh->diachi = $request->diachi;
        $dh->sodienthoai = $request->sodienthoai;
        $dh->tongtien = $tongtien;
        $dh->VAT = $VAT;

        if ($voucher) {
            $dh->voucher_id = $voucher->id; // lưu voucher vào hóa đơn
        }

        $dh->save();

        // 5. Lưu chi tiết hóa đơn và cập nhật số lượng sản phẩm
        foreach (Cart::content() as $value) {
            $ctdh = new DonHangChiTiet();
            $ctdh->donhang_id = $dh->id;
            $ctdh->sanpham_id = $value->id;
            $ctdh->soluong = $value->qty;
            $ctdh->dongia = $value->price;
            $ctdh->thanhtien = $value->qty * $value->price;
            $ctdh->hinhanh = $value->options->hinhanh;
            $ctdh->gia = $value->options->gia;
            $ctdh->khuyenmai = $value->options->khuyenmai;
            $ctdh->gia_khuyenmai = $value->options->gia_khuyenmai;
            $ctdh->save();

            // Cập nhật số lượng đã bán cho sản phẩm
            $sanpham = SanPham::find($value->id);
            if ($sanpham) {
                if ($sanpham->soluong < $value->qty) {
                    // có thể thông báo lỗi hoặc chỉ cập nhật số lượng còn lại
                }
                $sanpham->daban += $value->qty;
                $sanpham->soluong -= $value->qty;
                if ($sanpham->soluong <= 0) {
                    $sanpham->soluong = 0;
                    $sanpham->trangthai = 0; // hết hàng
                }
                $sanpham->save();
            }
        }

        // 6. Cộng điểm cho user (1 điểm mỗi 10.000 VNĐ)
        $user = Auth::user();
        $diem = floor($tongtien / 10000);
        $user->points += $diem;
        $user->save();

        // 7. Cập nhật voucher
        if ($voucher) {
            if ($voucher->so_luong > 1) {
                $voucher->decrement('so_luong');
            } else {
                $voucher->trang_thai = 0;
                $voucher->save();
            }
            session()->forget('voucher'); // xóa voucher trong session
        }

        // 8. Xóa giỏ hàng
        Cart::destroy();
        // Gởi email
        Mail::to(Auth::user()->email)->send(new DatHangThanhCongEmail($dh));


        return redirect()->route('user.dathangthanhcong')->with('success', 'Đặt hàng thành công!');
    }

    //Đánh giá
    public function getDanhGia()
    {
        if (Auth::check())
            return view('frontend.sanpham-chitiet');
        else
            return view('user.dangnhap');

    }

    public function postDanhGia(Request $request)
    {
        //kiểm tra đầu vào
        $this->validate($request, [
            'diachi' => ['required', 'string', 'max:255'],
            'sodienthoai' => ['required', 'string', 'size:10']
        ]);

        //lưu vào hóa đơn
        $dh = new DonHang();
        $dh->user_id = Auth::user()->id;
        $dh->tinhtrang = 1;//mặc định "chờ xác nhận"
        $dh->diachi = $request->diachi;
        $dh->sodienthoai = $request->sodienthoai;
        $dh->save();

        //lưu vào chi tiết
        foreach (Cart::content() as $value) {
            $ctdh = new DonHang_ChiTiet();

        }
        return redirect()->route('user.dathangthanhcong');
    }


    public function getDatHangThanhCong()
    {
        return view('user.dathangthanhcong');
    }

    public function getDonHang()
    {
        $donhang = DonHang::with('donhang_chitiet.sanpham')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(5); // 5 đơn / trang

        return view('user.donhang', compact('donhang'));
    }

    public function postDonHang(Request $request, $id)
    {
        //
    }

    public function getHoSo()
    {
        return redirect()->route('user.home');
    }

    public function postHoSo(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        ]);

        $orm = User::find($id);
        $orm->name = $request->name;
        $orm->username = Str::before($request->email, '@');
        $orm->email = $request->email;
        $orm->save();

        return redirect()->route('user.home')->with('success', 'Đã cập nhật thông tin thành công.');
    }

    public function postDoiMatKhau(Request $request)
    {
        $request->validate([
            'old_password' => ['required', 'string', 'max:255'],
            'new_password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::findOrFail(Auth::user()->id ?? 0);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('user.home')->with('success', 'Đổi mật khẩu thành công.');
        } else
            return redirect()->route('user.home')->with('warning', 'Mật khẩu cũ không chính xác.');
    }

    public function postDangXuat(Request $request)
    {
        // Bổ sung code tại đây
        return redirect()->route('frontend.home');
    }


    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            // Xóa ảnh cũ nếu có
            if ($user->hinhanh && Storage::disk('public')->exists($user->hinhanh)) {
                Storage::disk('public')->delete($user->hinhanh);
            }

            // Upload ảnh mới với tên file slug
            $extension = $request->file('avatar')->extension();
            $filename = Str::slug($user->name, '-') . '-' . time() . '.' . $extension;
            $path = Storage::disk('public')->putFileAs('anh-dai-dien', $request->file('avatar'), $filename);

            $user->hinhanh = $path;
            $user->save();

            return redirect()->back()->with('success', 'Cập nhật ảnh đại diện thành công!');
        }

        return redirect()->back()->with('warning', 'Vui lòng chọn ảnh để tải lên!');
    }




    public function getDSBinhLuan($id)
    {
        // Lấy tất cả bình luận cha của sản phẩm $id, kèm user và reply con
        $binhluans = BinhLuan::with(['user', 'binhluan_trl.user'])
            ->where('sanpham_id', $id)
            ->whereNull('parent_id') // chỉ lấy bình luận cha
            ->orderBy('created_at', 'desc')
            ->get();

        // Trả về JSON
        return view('frontend.sanpham-chitiet', compact('binhluan'));
    }

    public function postBinhLuan(Request $request)
    {
        // 1. Validate dữ liệu đầu vào
        $request->validate([
            'sanpham_id' => 'required|exists:sanpham,id',
            'noidung' => 'required|string',
            'parent_id' => 'nullable|exists:binhluan,id',
            'danhgia' => 'nullable|integer|between:1,5',
        ]);

        // 2. Tạo bình luận mới
        $comment = BinhLuan::create([
            'sanpham_id' => $request->sanpham_id,
            'user_id' => auth()->id(),
            'parent_id' => $request->parent_id,
            'danhgia' => $request->danhgia ?? 5,
            'noidung' => $request->noidung
        ]);

        // 3. Load user relationship
        $comment->load('user');

        // 4. Trả về response JSON với dữ liệu user
        return response()->json([
            'success' => true,
            'message' => 'Bình luận đã gửi thành công!',
            'comment' => [
                'id' => $comment->id,
                'noidung' => $comment->noidung,
                'danhgia' => $comment->danhgia,
                'created_at' => $comment->created_at->diffForHumans(),
                'user' => [
                    'name' => $comment->user->name,
                    'hinhanh' => $comment->user->hinhanh ?? 'assets/img/avatars/01.jpg',
                ]
            ]
        ]);
    }

    public function getMSPay()
    {
        $user = Auth::user();

        // Lấy 10 giao dịch MSPay gần nhất
        $walletTransactions = MspayTransaction::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('user.mspay', compact('walletTransactions'));
    }

    public function getVoucher()
    {
        $userId = Auth::id();

        $vouchers = UserVoucher::where('user_id', $userId)
            ->whereHas('voucher', function ($query) {
                $query->where('trang_thai', 1)
                    ->where('so_luong', '>', 0)
                    ->whereDate('het_han', '>=', now());
            })
            ->with('voucher')
            ->get();

        return view('user.voucher', compact('vouchers'));
    }


    public function postVoucher(Request $request)
    {
        $user = Auth::user();
        $points = (int) $request->points; // số điểm user muốn đổi

        // Kiểm tra điểm
        if ($user->points < $points) {
            return back()->with('error', 'Điểm của bạn không đủ để đổi voucher.');
        }

        // Ví dụ: 1000 điểm = 100.000 VNĐ
        $voucherValue = ($points / 1000) * 100000;

        // Tạo voucher mới
        $voucher = Voucher::create([
            'ma_voucher' => 'VOUCHER' . time(),
            'diem_can_doi' => $points,
            'gia_tri' => $voucherValue,
            'so_luong' => 1,
            'het_han' => now()->addDays(30),
            'trang_thai' => 1,
        ]);

        // Gán voucher cho user
        UserVoucher::create([
            'user_id' => $user->id,
            'voucher_id' => $voucher->id,
            'used_count' => 0
        ]);

        // Trừ điểm user
        $user->points -= $points;
        $user->save();

        return back()->with('success', 'Bạn đã đổi voucher thành công!');
    }



    public function apply(Request $request)
    {
        $ma_voucher = $request->ma_voucher;

        if (!$ma_voucher) {
            return back()->with('error', 'Vui lòng chọn voucher.');
        }

        // Lấy voucher của user
        $userVoucher = UserVoucher::with('voucher')
            ->where('user_id', Auth::id())
            ->whereHas('voucher', function ($q) use ($ma_voucher) {
                $q->where('ma_voucher', $ma_voucher)
                    ->where('trang_thai', 1)
                    ->where('so_luong', '>', 0)
                    ->whereDate('het_han', '>=', Carbon::today());
            })
            ->first();

        if (!$userVoucher) {
            return back()->with('error', 'Voucher không hợp lệ hoặc đã hết hạn.');
        }

        // Lưu voucher vào session
        session(['voucher' => $userVoucher->voucher]);

        return back()->with('success', 'Voucher đã được áp dụng!');
    }

    public function getHopDongTraGop()
    {
        $cart = session('cart')['default'] ?? null;

        if (!$cart || $cart->count() == 0) {
            return back()->with('error', 'Giỏ hàng đang trống!');
        }

        $firstItem = $cart->first();
        $sanpham_id = $firstItem->id;

        $sanpham = SanPham::find($sanpham_id);

        return view('user.hopdongtragop', [
            'sanpham' => $sanpham,
            'item' => $firstItem
        ]);
    }

    public function postHopDongTraGop(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string',
            'cccd' => 'required|string|max:20',
            'dia_chi' => 'required|string',
            'sdt' => 'required|string|max:15',
            'tra_truoc' => 'required|integer|min:0|max:100',
            'thoi_han' => 'required|integer|min:1',
            'sanpham_id' => 'required|exists:sanpham,id'
        ]);

        $user = Auth::user();

        // Kiểm tra hợp đồng chưa hoàn thành
        $existing = HopDongTraGop::where('user_id', $user->id)
            ->where('trang_thai_hop_dong', 0)
            ->first();

        if ($existing) {
            return back()->with('error', 'Bạn đang có một hợp đồng trả góp chưa hoàn thành!');
        }

        // Lấy sản phẩm
        $sp = SanPham::find($request->sanpham_id);

        // Chọn giá theo khuyến mãi
        $gia = $sp->khuyenmai > 0 ? $sp->gia_khuyenmai : $sp->gia;

        // Tính toán tiền
        $soTienTraTruoc = ($gia * $request->tra_truoc) / 100;


        //$laiSuat = 1.2; // % mỗi tháng
        $soTienConLai = $gia - $soTienTraTruoc;

        if ($request->thoi_han == 3)
            $laiSuat = 0.5;
        elseif ($request->thoi_han == 6)
            $laiSuat = 1;
        elseif ($request->thoi_han == 9)
            $laiSuat = 1.5;
        elseif ($request->thoi_han == 12)
            $laiSuat = 1.8;

        $tongTienPhaiTra = $soTienConLai * (1 + ($laiSuat * $request->thoi_han) / 100);
        $tienMoiThang = $tongTienPhaiTra / $request->thoi_han;

        HopDongTraGop::create([
            'user_id' => $user->id,
            'sanpham_id' => $sp->id,
            'thoi_han' => $request->thoi_han,
            'tra_truoc' => $request->tra_truoc,
            'gia_san_pham' => $gia,
            'so_tien_tra_truoc' => $soTienTraTruoc,
            'so_tien_con_lai' => $soTienConLai,
            'lai_suat_hang_thang' => $laiSuat,
            'so_tien_tra_moi_thang' => $tienMoiThang,
            'ho_ten' => $request->ho_ten,
            'cccd' => $request->cccd,
            'dia_chi' => $request->dia_chi,
            'sdt' => $request->sdt,
            'trang_thai_hop_dong' => 0,
            'duyet' => 0,
        ]);

        return redirect()->route('user.hoso.tragop')->with('success', 'Tạo hợp đồng trả góp thành công!');
    }


    // Trong UserController hoặc HopDongTraGopController
    public function getHoSoTraGop()
    {
        $hopDongs = HopDongTraGop::where('user_id', Auth::id())
            ->with('sanpham') // Eager loading
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.hosotragop', compact('hopDongs'));
    }


}