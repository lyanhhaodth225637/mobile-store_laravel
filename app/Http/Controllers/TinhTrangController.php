<?php

namespace App\Http\Controllers;

use App\Models\TinhTrang;
use Illuminate\Http\Request;

class TinhTrangController extends Controller
{
   public function getDanhSach()
    {
        $tinhtrang = TinhTrang::orderBy('tinhtrang', 'asc')->get();
        return view('admin.tinhtrang.danhsach', compact('tinhtrang'));
    }

    public function getThem()
    {
        return view('admin.tinhtrang.them');
    }


    //chưa sửa
    public function postThem(Request $request)
    {
        $request->validate([
            'tenloai' => ['required', 'string', 'max:255', 'unique:loaisanpham,tenloai'],
        ]);

        $orm = new LoaiSanPham();
        $orm->tenloai = Str::title($request->tenloai);
        $orm->tenloai_slug = Str::slug($orm->tenloai, '-');
        $orm->save();

        return redirect()->route('admin.loaisanpham')->with('success', 'Thêm loại sản phẩm thành công!');
    }

    public function getSua($id)
    {
        $loaisanpham = LoaiSanPham::findOrFail($id);

        return view('admin.loaisanpham.sua', compact('loaisanpham'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tenloai' => ['required', 'string', 'max:255', Rule::unique('loaisanpham', 'tenloai')->ignore($id)],
        ]);

        $orm = LoaiSanPham::findOrFail($id);
        $orm->tenloai = Str::title($request->tenloai);
        $orm->tenloai_slug = Str::slug($orm->tenloai, '-');
        $orm->save();

        return redirect()->route('admin.loaisanpham')->with('success', 'Cập nhật loại sản phẩm thành công!');
    }

    public function getXoa($id)
    {
        $orm = LoaiSanPham::find($id);
        if ($orm) {
            $orm->delete();
            return redirect()->route('admin.loaisanpham')->with('success', 'Xóa thành công');
        }
        return redirect()->route('admin.loaisanpham')->with('error', 'Lỗi khi xóa');
    }
}
