<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\MspayTransaction;
use App\Models\DonHang;
use App\Models\DonHangChiTiet;
use App\Models\SanPham;
use Illuminate\Support\Facades\Mail;
use App\Mail\DatHangThanhCongEmail;

use Cart;

class MSPayController extends Controller
{
    public function postDk_MSPay_Pin(Request $request)
    {
        // 1. Validate
        $request->validate([
            'pin' => 'required|digits:6|confirmed',
        ], [
            'pin.required' => 'Vui lòng nhập mã PIN',
            'pin.digits' => 'Mã PIN phải đúng 6 chữ số',
            'pin.confirmed' => 'Mã PIN xác nhận không khớp',
        ]);

        $user = Auth::user();

        // 2. Kiểm tra đã có PIN chưa
        if ($user->mspay_pin !== null) {
            return back()->with('error', 'Bạn đã đăng ký MSPay rồi');
        }

        // 3. Lưu PIN (HASH để bảo mật)
        $user->mspay_pin = Hash::make($request->pin);
        $user->save();

        return back()->with('success', 'Đăng ký MSPay thành công');
    }
    public function postNapTien_MSPay(Request $request)
    {
        // 1. Validate
        $request->validate([
            'amount' => 'required|integer|min:10000',
            'payment_method' => 'required|in:bank_transfer,momo,vnpay,zalopay',
            'pin' => 'required|digits:6',
        ], [
            'pin.required' => 'Vui lòng nhập mã PIN MSPay',
            'pin.digits' => 'Mã PIN phải gồm 6 chữ số',
        ]);

        $user = Auth::user();

        // 2. Kiểm tra đã đăng ký MSPay chưa
        if ($user->mspay_pin === null) {
            return back()->with('error', 'Bạn chưa đăng ký MSPay');
        }

        // 3. Kiểm tra PIN
        if (!Hash::check($request->pin, $user->mspay_pin)) {
            return back()->with('error', 'Mã PIN không chính xác');
        }

        DB::beginTransaction();

        try {
            $soDuTruoc = $user->mspay_balance;

            // 4. Cộng tiền vào ví
            $user->mspay_balance += $request->amount;
            $user->save();

            // 5. Ghi lịch sử giao dịch
            MspayTransaction::create([
                'user_id' => $user->id,
                'donhang_id' => null,
                'loai_giao_dich' => 'nap_tien',
                'so_tien' => $request->amount,
                'so_du_truoc' => $soDuTruoc,
                'so_du_sau' => $user->mspay_balance,
                'mo_ta' => 'Nạp tiền qua ' . strtoupper($request->payment_method),
            ]);

            DB::commit();

            return back()->with('success', 'Nạp tiền MSPay thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function postDatHangMSPay(Request $request)
    {
        // 1. Validate
        $request->validate([
            'diachi' => 'required|string|max:255',
            'sodienthoai' => 'required|string|size:10',
            'pin' => 'required|digits:6',
        ]);

        $user = Auth::user();

        // 2. Kiểm tra MSPay
        if (!$user->mspay_pin) {
            return back()->with('error', 'Bạn chưa đăng ký MSPay');
        }

        if (!Hash::check($request->pin, $user->mspay_pin)) {
            return back()->with('error', 'Mã PIN không chính xác');
        }

        // 3. Voucher
        $voucher = session('voucher');

        // 4. Tính tiền
        $tongtien = (double) str_replace('.', '', Cart::total());
        $VAT = (double) str_replace('.', '', Cart::tax());

        if ($voucher) {
            $tongtien -= $voucher->gia_tri;
            $tongtien = max($tongtien, 0);
        }

        // 5. Kiểm tra số dư
        if ($user->mspay_balance < $tongtien) {
            return back()->with('error', 'Số dư MSPay không đủ để thanh toán');
        }

        DB::beginTransaction();

        try {
            // 6. Trừ tiền ví
            $soDuTruoc = $user->mspay_balance;
            $user->mspay_balance -= $tongtien;
            $user->save();

            // 7. Tạo đơn hàng
            $dh = new DonHang();
            $dh->user_id = $user->id;
            $dh->tinhtrang_id = 1;
            $dh->diachi = $request->diachi;
            $dh->sodienthoai = $request->sodienthoai;
            $dh->tongtien = $tongtien;
            $dh->VAT = $VAT;
            if ($voucher) {
                $dh->voucher_id = $voucher->id;
            }
            $dh->save();

            // 8. Chi tiết đơn hàng
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

                $sanpham = SanPham::find($value->id);
                if ($sanpham) {
                    $sanpham->daban += $value->qty;
                    $sanpham->soluong -= $value->qty;
                    if ($sanpham->soluong <= 0) {
                        $sanpham->soluong = 0;
                        $sanpham->trangthai = 0;
                    }
                    $sanpham->save();
                }
            }

            // 9. Ghi lịch sử MSPay
            MspayTransaction::create([
                'user_id' => $user->id,
                'donhang_id' => $dh->id,
                'loai_giao_dich' => 'thanh_toan',
                'so_tien' => $tongtien,
                'so_du_truoc' => $soDuTruoc,
                'so_du_sau' => $user->mspay_balance,
                'mo_ta' => 'Thanh toán đơn hàng #' . $dh->id,
            ]);

            // 10. Cộng điểm
            $user->points += floor($tongtien / 10000);
            $user->save();

            // 11. Voucher
            if ($voucher) {
                if ($voucher->so_luong > 1) {
                    $voucher->decrement('so_luong');
                } else {
                    $voucher->trang_thai = 0;
                    $voucher->save();
                }
                session()->forget('voucher');
            }

            // 12. Xóa giỏ
            Cart::destroy();
            Mail::to(Auth::user()->email)->send(new DatHangThanhCongEmail($dh));

            DB::commit();

            return redirect()->route('user.dathangthanhcong')
                ->with('success', 'Thanh toán MSPay thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra khi thanh toán');
        }
    }
}
