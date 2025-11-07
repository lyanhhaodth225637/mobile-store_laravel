<?php

use App\Http\Controllers\HangSanXuatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoaiSanPhamController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.home');
})->name('admin.home');

// Quản lý Loại sản phẩm
Route::get('/admin/loaisanpham', [LoaiSanPhamController::class, 'getDanhSach'])->name('admin.loaisanpham');
Route::get('/admin/loaisanpham/them', [LoaiSanPhamController::class, 'getThem'])->name('admin.loaisanpham.them');
Route::post('/admin/loaisanpham/them', [LoaiSanPhamController::class, 'postThem'])->name('admin.loaisanpham.them');
Route::get('/admin/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'getSua'])->name('admin.loaisanpham.sua');
Route::post('/admin/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'postSua'])->name('admin.loaisanpham.sua');
Route::get('/admin/loaisanpham/xoa/{id}', [LoaiSanPhamController::class, 'getXoa'])->name('admin.loaisanpham.xoa');
//Hsx
Route::get('/admin/hangsanxuat', [HangSanXuatController::class, 'getDanhSach'])->name('admin.hangsanxuat');
Route::get('/admin/hangsanxuat/them', [HangSanXuatController::class, 'getThem'])->name('admin.hangsanxuat.them');
Route::post('/admin/hangsanxuat/them', [HangSanXuatController::class, 'postThem'])->name('admin.hangsanxuat.them');
Route::get('/admin/hangsanxuat/xoa/{id}', [HangSanXuatController::class, 'getXoa'])->name('admin.hangsanxuat.xoa');
