<?php
namespace App\Http\Controllers;
use App\Models\DonHang;
use App\Models\DonHangChiTiet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        //kiểm tra đăng nhập
        if (Auth::check()) {
            return view('user.dathang');
        } else {
            return view('user.dangnhap');
        }
    }

    public function postDatHang(Request $request)
    {
        //kiểm tra đầu vào
        $this->validate($request, [
            'diachi' => ['required', 'string', 'max:255'],
            'sodienthoai' => ['required', 'string', 'size:10']
        ]);

        //lưu vào hóa đơn
        $dh = new DonHang();
        $dh->user_id = Auth::user()->id;
        $dh->tinhtrang_id = 1;//mặc định "chờ xác nhận"
        $dh->diachi = $request->diachi;
        $dh->sodienthoai = $request->sodienthoai;

        $tongtien = (Double) str_replace('.', '', Cart::total());
        $dh->tongtien = $tongtien;

        $VAT = (Double) str_replace('.', '', Cart::tax());
        $dh->VAT = $VAT;

        $dh->save();

        //lưu vào chi tiết hóa đơn
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
        }

        // Cộng điểm khi mua hàng (giả sử 1% tổng tiền làm điểm, và User có trường 'diem')
        $user = Auth::user();
        $diem = floor($tongtien / 10000); // Ví dụ: 1 điểm cho mỗi 100 VNĐ, điều chỉnh theo logic của bạn
        $user->points += $diem; // Giả sử trường điểm tên 'diem'
        $user->save();

        return redirect()->route('user.dathangthanhcong');
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

    public function getDonHang($id = '')
    {
        // Bổ sung code tại đây
        return view('user.donhang');
    }

    public function postDonHang(Request $request, $id)
    {
        // Bổ sung code tại đây
    }

    public function getHoSo()
    {
        return redirect()->route('user.home');
    }

    public function postHoSo(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'name' => ['requiredd', 'string', 'max:255'],
            'email' => ['requiredd', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
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
}