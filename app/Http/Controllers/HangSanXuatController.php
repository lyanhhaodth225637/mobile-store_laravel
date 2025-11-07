<?php

namespace App\Http\Controllers;

use App\Models\HangSanXuat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class HangSanXuatController extends Controller
{
    public function getDanhSach()
    {
        $hangsanxuat = HangSanXuat::orderBy('tenhang', 'asc')->get();
        return view('admin.hangsanxuat.danhsach', compact('hangsanxuat'));
    }

    public function getThem()
    {
        return view('admin.hangsanxuat.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'tenhang' => ['required', 'string', 'max:255', 'unique:hangsanxuat,tenhang'],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
        ]);

        //upload hình
        $path = null;
        if ($request->hasFile('hinhanh')) {
            $extention = $request->file('hinhanh')->extension();
            $filename = Str::slug($request->tenhang, '-') . '.' . $extention;
            $path = Storage::disk('public')->putFileAs('hang-san-xuat', $request->file('hinhanh'), $filename);
        }

        $orm = new HangSanXuat();
        $orm->tenhang = Str::title($request->tenhang);
        $orm->tenhang_slug = Str::slug($orm->tenhang, '-');
        $orm->hinhanh = $path ?? null;
        $orm->save();

        return redirect()->route('admin.hangsanxuat')->with('success', 'Thêm hãng sản xuất thành công!');
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
        $orm = HangSanXuat::find($id);
        if ($orm) {
            $orm->delete();
            return redirect()->route('admin.hangsanxuat')->with('success', 'Xóa thành công');
        }
        return redirect()->route('admin.hangsanxuat')->with('error', 'Lỗi khi xóa');
    }

}
