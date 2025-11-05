<?php

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
Route::get('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'getSua'])->name('loaisanpham.sua');
Route::post('/loaisanpham/sua/{id}', [LoaiSanPhamController::class, 'postSua'])->name('loaisanpham.sua');
Route::get('/loaisanpham/xoa/{id}', [LoaiSanPhamController::class, 'getXoa'])->name('loaisanpham.xoa');
