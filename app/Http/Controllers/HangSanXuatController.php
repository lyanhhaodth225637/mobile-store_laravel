<?php

namespace App\Http\Controllers;

use App\Models\HangSanXuat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Imports\HangSanXuatImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HangSanXuatExport;


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
            'tenhang' => ['required', 'string', 'max:255', Rule::unique('hangsanxuat', 'tenhang')->ignore($id)],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
        ]);

       
        //upload hình
        $path = null;
        if ($request->hasFile('hinhanh')) {
            // Xóa file cũ
            $orm = HangSanXuat::find($id);
            if (!empty($orm->hinhanh))
                Storage::delete($orm->hinhanh);

            $extention = $request->file('hinhanh')->extension();
            $filename = Str::slug($request->tenhang, '-') . '.' . $extention;
            $path = Storage::disk('public')->putFileAs('hang-san-xuat', $request->file('hinhanh'), $filename);
        }

        $orm = HangSanXuat::findOrFail($id);
        $orm->tenhang = Str::title($request->tenhang);
        $orm->tenhang_slug = Str::slug($orm->tenhang, '-');
        $orm->hinhanh = $path ?? $orm->hinhanh ?? null;
        $orm->save();

        return redirect()->route('admin.hangsanxuat')->with('success', 'Cập nhật hãng sản xuất thành công!');
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



    public function postNhap(Request $request)
    {
        
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv|max:5120', // Giới hạn 5MB
        ], [
            'file_excel.required' => 'Vui lòng chọn file Excel để nhập!',
            'file_excel.mimes' => 'Chỉ chấp nhận file có định dạng .xlsx, .xls, .csv!',
            'file_excel.max' => 'Kích thước file tối đa là 5MB!',
        ]);

        try {
            Excel::import(new HangSanXuatImport, $request->file('file_excel'));
            return redirect()->route('admin.hangsanxuat')->with('success', 'Nhập dữ liệu thành công!');
        } catch (Exception $e) {
            
            return redirect()->route('admin.hangsanxuat')->with('error', 'File Excel không hợp lệ hoặc bị lỗi!');
        }
    }

    public function getXuat()
    {
        return Excel::download(new HangSanXuatExport(), 'hang-san-xuat.xlsx');   
    }


}
