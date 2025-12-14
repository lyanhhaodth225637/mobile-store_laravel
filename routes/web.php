<?php

use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\HangSanXuatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HopDongTraGopController;
use App\Http\Controllers\MSPayController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\LoaiSanPhamController;
use App\Http\Controllers\QuanTriVienController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\TinhTrangController;
use App\Http\Controllers\UserController;
use App\Models\HopDongTraGop;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/admin', function () {
//     return view('admin.home');
// })->name('admin.home');  
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'gethome'])->name('home');

Route::get('/login/google', [HomeController::class, 'getGoogleLogin'])->name('google.login');
Route::get('/login/google/callback', [HomeController::class, 'getGoogleCallback'])->name('google.callback');


//ADMIN
Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
    // Trang chủ của giao diện quản trị
    Route::get('/', [QuanTriVienController::class, 'getHome'])->name('home');
    Route::get('/home', [QuanTriVienController::class, 'getHome'])->name('home');

    // Quản lý Loại sản phẩm
    Route::get('/loaisanpham', [LoaiSanPhamController::class, 'getDanhSach'])->name('loaisanpham');
    Route::get('/loaisanpham/them', [LoaiSanPhamController::class, 'getThem'])->name('loaisanpham.them');
    Route::post('/loaisanpham/them', [LoaiSanPhamController::class, 'postThem'])->name('loaisanpham.them');
    Route::get('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'getSua'])->name('loaisanpham.sua');
    Route::post('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'postSua'])->name('loaisanpham.sua');
    Route::get('/loaisanpham/xoa/{id}', [LoaiSanPhamController::class, 'getXoa'])->name('loaisanpham.xoa');

    //Hãng sản xuất
    Route::get('/hangsanxuat', [HangSanXuatController::class, 'getDanhSach'])->name('hangsanxuat');
    Route::get('/hangsanxuat/them', [HangSanXuatController::class, 'getThem'])->name('hangsanxuat.them');
    Route::post('/hangsanxuat/them', [HangSanXuatController::class, 'postThem'])->name('hangsanxuat.them');
    Route::get('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'getSua'])->name('hangsanxuat.sua');
    Route::post('/hangsanxuat/sua/{id}', [HangSanXuatController::class, 'postSua'])->name('hangsanxuat.sua');
    Route::get('/hangsanxuat/xoa/{id}', [HangSanXuatController::class, 'getXoa'])->name('hangsanxuat.xoa');
    Route::post('/hangsanxuat/nhap', [HangSanXuatController::class, 'postNhap'])->name('hangsanxuat.nhap');
    Route::get('/hangsanxuat/xuat', [HangSanXuatController::class, 'getXuat'])->name('hangsanxuat.xuat');

    //tình trạng
    Route::get('/tinhtrang', [TinhTrangController::class, 'getDanhSach'])->name('tinhtrang');
    Route::get('/tinhtrang/xoa/{id}', [TinhTrangController::class, 'getXoa'])->name('tinhtrang.xoa');
    Route::get('/tinhtrang/them', [TinhTrangController::class, 'getThem'])->name('tinhtrang.them');
    Route::post('/tinhtrang/them', [TinhTrangController::class, 'postThem'])->name('tinhtrang.them');

    Route::get('/tinhtrang/sua/{id}', [TinhTrangController::class, 'getSua'])->name('tinhtrang.sua');
    Route::post('/tinhtrang/sua/{id}', [TinhTrangController::class, 'postSua'])->name('tinhtrang.sua');


    //sản phẩm
    Route::get('/sanpham', [SanPhamController::class, 'getDanhSach'])->name('sanpham');
    Route::get('/sanpham/them', [SanPhamController::class, 'getThem'])->name('sanpham.them');
    Route::post('/sanpham/them', [SanPhamController::class, 'postThem'])->name('sanpham.them');
    Route::get('/sanpham/sua/{id}', [SanPhamController::class, 'getSua'])->name('sanpham.sua');
    Route::post('/sanpham/sua/{id}', [SanPhamController::class, 'postSua'])->name('sanpham.sua');
    Route::get('/sanpham/xoa/{id}', [SanPhamController::class, 'getXoa'])->name('sanpham.xoa');
    Route::get('/sanpham/loc', [SanPhamController::class, 'getLoc'])->name('sanpham.loc');
    Route::get('/sanpham/chitiet/{id}', [SanPhamController::class, 'getSanPham_ChiTiet'])->name('sanpham.chitiet');
    Route::get('/sanpham/khuyenmai', [SanPhamController::class, 'getSanPham_KhuyenMai'])->name('sanpham.khuyenmai');
    //nhập, xuất excel
    Route::post('/sanpham/nhap', [SanPhamController::class, 'postNhap'])->name('sanpham.nhap');
    Route::get('/sanpham/xuat', [SanPhamController::class, 'getXuat'])->name('sanpham.xuat');

    //user
    Route::get('/user', [UserController::class, 'getDanhSach'])->name('user');
    Route::get('/user/them', [UserController::class, 'getThem'])->name('user.them');
    Route::post('/user/them', [UserController::class, 'postThem'])->name('user.them');
    Route::get('/user/sua/{id}', [UserController::class, 'getSua'])->name('user.sua');
    Route::post('/user/sua/{id}', [UserController::class, 'postSua'])->name('user.sua');
    Route::get('/user/xoa/{id}', [UserController::class, 'getXoa'])->name('user.xoa');
    Route::get('/user/loc', [UserController::class, 'getLoc'])->name('user.loc');
    Route::get('/user/khach-hang-moi', [UserController::class, 'getKhachHang_Moi'])->name('user.khachhang_moi');
    Route::get('/user/khach-hang-than-thiet', [UserController::class, 'getKhachHang_ThanThiet'])->name('user.khachhang_thanthiet');
    Route::get('/user/khach-hang-vip', [UserController::class, 'getKhachHang_VIP'])->name('user.khachhang_vip');

    //đơn hàng
    Route::get('/donhang', [DonHangController::class, 'getDanhSanh'])->name('donhang');
    Route::get('/donhang/chitiet/{id}', [DonHangController::class, 'getDonHang_ChiTiet'])->name('donhang.chitiet');


    //Hợp đồng trả góp
    Route::get('/hopdongtragop', [HopDongTraGopController::class, 'getDanhSach'])->name('hopdongtragop');
    Route::post('/hopdongtragop/{id}/duyet', [HopDongTraGopController::class, 'postDuyet'])->name('hopdongtragop.duyet');
    Route::get('/hopdongtragop/loc', [HopDongTraGopController::class, 'getLoc'])->name('hopdongtragop.loc');


    Route::get('/binhluan', [BinhLuanController::class, 'getDSBinhLuan'])->name('binhluan');
    Route::get('/binhluan/loc', [BinhLuanController::class, 'getLoc'])->name('binhluan.loc');


});


// Trang khách hàng
Route::get('/user/dang-ky', [HomeController::class, 'getDangKy'])->name('user.dangky');
Route::get('/user/dang-nhap', [HomeController::class, 'getDangNhap'])->name('user.dangnhap');
// Trang tài khoản khách hàng
Route::prefix('user')->name('user.')->middleware('role:user')->group(function () {
    // Trang chủ của giao diện khách hàng
    Route::get('/', [KhachHangController::class, 'getHome'])->name('home');
    Route::get('/home', [KhachHangController::class, 'getHome'])->name('home');

    // Đặt hàng
    Route::get('/dat-hang', [KhachHangController::class, 'getDatHang'])->name('dathang');
    Route::post('/dat-hang', [KhachHangController::class, 'postDatHang'])->name('dathang');
    Route::get('/dat-hang-thanh-cong', [KhachHangController::class, 'getDatHangThanhCong'])->name('dathangthanhcong');

    //bình luận đánh giá
    // POST bình luận hoặc reply
    Route::post('/binh-luan', [KhachHangController::class, 'postBinhLuan'])->name('binhluan');
    // Lấy danh sách bình luận của sản phẩm bằng AJAX
    Route::get('/sanpham/{id}/binh-luan', [KhachHangController::class, 'getDSBinhLuan'])->name('user.getDSBinhLuan');
    // POST like/dislike bình luận
    Route::post('/binh-luan/{id}/like', [BinhLuanController::class, 'like'])->name('binhluan.like');

    // Xem và cập nhật trạng thái đơn hàng
    Route::get('/don-hang', [KhachHangController::class, 'getDonHang'])->name('donhang');
    Route::get('/don-hang/{id}', [KhachHangController::class, 'getDonHang'])->name('donhang.chitiet');
    Route::post('/don-hang/{id}', [KhachHangController::class, 'postDonHang'])->name('donhang.chitiet');

    // Cập nhật thông tin tài khoản
    Route::get('/ho-so', [KhachHangController::class, 'getHoSo'])->name('hoso');
    Route::post('/ho-so', [KhachHangController::class, 'postHoSo'])->name('hoso');

    // Đổi mật khẩu
    Route::get('/doi-mat-khau', [KhachHangController::class, 'getDoiMatKhau'])->name('doimatkhau');
    Route::post('/doi-mat-khau', [KhachHangController::class, 'postDoiMatKhau'])->name('doimatkhau');

    // Đăng xuất
    Route::post('/dang-xuat', [KhachHangController::class, 'postDangXuat'])->name('dangxuat');
    Route::post('/upload-avatar', [KhachHangController::class, 'uploadAvatar'])->name('upload.avatar');

    //voucher 
    Route::get('/voucher', [KhachHangController::class, 'getVoucher'])->name('voucher');
    Route::post('/voucher', [KhachHangController::class, 'postVoucher'])->name('voucher');
    Route::post('/apply-voucher', [KhachHangController::class, 'apply'])->name('apply-voucher');

    //
    Route::get('/mspay', [KhachHangController::class, 'getMSPay'])->name('mspay');

    //trả góp
    Route::get('/hop-dong/tra-gop', [KhachHangController::class, 'getHopDongTraGop'])->name('hopdong.tragop');
    // Lưu hợp đồng trả góp
    Route::post('/hop-dong/tra-gop/luu', [KhachHangController::class, 'postHopDongTraGop'])->name('hopdong.tragop.luu');

    Route::get('/ho-so/tra-gop', [KhachHangController::class, 'getHoSoTraGop'])->name('hoso.tragop');

    // ví MSPay
    Route::get('/mspay', [KhachHangController::class, 'getMSPay'])->name('mspay');

    Route::post('/mspay/dang-ky-pin', [MSPayController::class, 'postDk_MSPay_Pin'])->name('mspay.dk_pin');
    Route::post('/mspay/nap-tien', [MSPayController::class, 'postNapTien_MSPay'])->name('mspay.naptien');

    Route::post('/dat-hang/mspay', [MSPayController::class, 'postDatHangMSPay'])->name('dathang.mspay');


});


// Các trang dành cho khách chưa đăng  
Route::name('frontend.')->group(function () {
    // Trang chủ    
    Route::get('/', [HomeController::class, 'getHome'])->name('home');
    //Biên soạn: Nguyễn Hoàng Tùng (nhtung.id.vn).
    Route::get('/home', [HomeController::class, 'getHome'])->name('home');

    // Trang sản phẩm
    Route::get('/san-pham', [HomeController::class, 'getSanPham'])->name('sanpham');
    Route::get('/san-pham/{tenloai_slug}', [HomeController::class, 'getSanPham'])->name('sanpham.phanloai');
    Route::get('/san-pham/{tenloai_slug}/loc', [HomeController::class, 'getLoc'])->name('sanpham.loc');
    Route::get('/san-pham/{tenloai_slug}/{tensanpham_slug}', [HomeController::class, 'getSanPham_ChiTiet'])->name('sanpham.chitiet');

    // Tin tức
    Route::get('/bai-viet', [HomeController::class, 'getBaiViet'])->name('baiviet');
    Route::get('/bai-viet/{tenchude_slug}', [HomeController::class, 'getBaiViet'])->name('baiviet.chude');
    Route::get('/bai-viet/{tenchude_slug}/{tieude_slug}', [HomeController::class, 'getBaiViet_ChiTiet'])->name('baiviet.chitiet');

    // Trang giỏ hàng
    Route::get('/gio-hang', [HomeController::class, 'getGioHang'])->name('giohang');
    Route::post('/gio-hang/them/', [HomeController::class, 'postGioHang_Them'])->name('giohang.them');
    Route::get('/gio-hang/xoa/{row_id}', [HomeController::class, 'getGioHang_Xoa'])->name('giohang.xoa');
    Route::get('/gio-hang/giam/{row_id}', [HomeController::class, 'getGioHang_Giam'])->name('giohang.giam');
    Route::get('/gio-hang/tang/{row_id}', [HomeController::class, 'getGioHang_Tang'])->name('giohang.tang');

    // Tuyển dụng
    Route::get('/tuyen-dung', [HomeController::class, 'getTuyenDung'])->name('tuyendung');

    // Liên hệ
    Route::get('/lien-he', [HomeController::class, 'getLienHe'])->name('lienhe');

    //trả góp
    Route::get('/tra-gop', [HomeController::class, 'getTraGop'])->name('tragop');


    Route::get('/timkiem', [HomeController::class, 'getTimkiem'])->name('timkiem');

    Route::get('/timkiem/loc', [HomeController::class, 'getLocTK'])->name('timkiem.loc');
});



