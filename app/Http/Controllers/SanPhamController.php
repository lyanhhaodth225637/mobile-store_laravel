<?php

namespace App\Http\Controllers;

use App\Imports\SanPhamImxport;
use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Models\HangSanXuat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SanPhamExport;



class SanPhamController extends Controller
{
    public function getDanhSach()
    {
        $loaisanpham = LoaiSanPham::all();
        $hangsanxuat = HangSanXuat::all();
        $sanpham = SanPham::with(['LoaiSanPham', 'HangSanXuat'])
            ->latest() // tự động sắp xếp theo updated_at desc
            ->get();

        return view('admin.sanpham.danhsach', compact('sanpham', 'loaisanpham', 'hangsanxuat'));
    }
    public function getSanPham_ChiTiet($id)
    {
        $sanpham = SanPham::findOrFail($id);
        return view('admin.sanpham.chitiet', compact('sanpham'));
    }
    public function getSanPham_KhuyenMai()
    {
        $loaisanpham = LoaiSanPham::all();
        $hangsanxuat = HangSanXuat::all();
        $sanpham = SanPham::with(['LoaiSanPham', 'HangSanXuat'])
            ->where('khuyenmai', '>', 0)
            ->get();

        return view('admin.sanpham.khuyenmai', compact('sanpham', 'loaisanpham', 'hangsanxuat'));
    }

    public function getThem()
    {
        return view('admin.sanpham.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'tensanpham' => ['required', 'string', 'max:255', 'unique:sanpham,tensanpham'],
            'gia' => ['required', 'numeric', 'min:0.01'],
            'soluong' => ['required', 'integer', 'min:0'],
            'khuyenmai' => ['nullable', 'integer', 'min:0', 'max:100'],
            'mota' => ['nullable', 'string', 'max:255'],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
            'loaisanpham_id' => ['required', 'exists:loaisanpham,id'],
            'hangsanxuat_id' => ['required', 'exists:hangsanxuat,id'],
        ]);


        //upload hình

        $path = null;
        if ($request->hasFile('hinhanh')) {
            // Tạo thư mục nếu chưa có
            $lsp = LoaiSanPham::find($request->loaisanpham_id);
            Storage::exists($lsp->tenloai_slug) or Storage::makeDirectory($lsp->tenloai_slug, 0775);

            // Xác định tên tập tin
            $extension = $request->file('hinhanh')->extension();
            $filename = Str::slug($request->tensanpham, '-') . '.' . $extension;
            // Upload vào thư mục và trả về đường dẫn
            $path = Storage::disk('public')->putFileAs($lsp->tenloai_slug, $request->file('hinhanh'), $filename);
        }


        $orm = new SanPham();
        $orm->tensanpham = Str::title($request->tensanpham);
        $orm->tensanpham_slug = Str::slug($orm->tensanpham, '-');
        $orm->hinhanh = $path ?? null;
        $orm->mota = $request->mota;
        $orm->soluong = $request->soluong;
        $orm->gia = $request->gia;
        $orm->khuyenmai = $request->khuyenmai ?? 0;
        $orm->gia_khuyenmai = $request->gia - ($request->gia * $request->khuyenmai / 100);
        $orm->trangthai = $request->trangthai;
        $orm->loaisanpham_id = $request->loaisanpham_id;
        $orm->hangsanxuat_id = $request->hangsanxuat_id;

        $orm->save();


        return redirect()->route('admin.sanpham')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function getSua($id)
    {
        $sanpham = SanPham::findOrFail($id);

        return view('admin.sanpham.sua', compact('sanpham'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tensanpham' => ['required', 'string', 'max:255', Rule::unique('sanpham', 'tensanpham')->ignore($id)],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
            'gia' => ['required', 'numeric', 'min:0.01'],
            'soluong' => ['required', 'integer', 'min:0'],
            'khuyenmai' => ['nullable', 'integer', 'min:0', 'max:100'],
            'mota' => ['nullable', 'string', 'max:255'],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
            'loaisanpham_id' => ['required', 'exists:loaisanpham,id'],
            'hangsanxuat_id' => ['required', 'exists:hangsanxuat,id'],
        ]);

        //upload hình

        $path = null;
        if ($request->hasFile('hinhanh')) {
            // Xóa file cũ
            $sp = SanPham::find($id);
            if (!empty($sp->hinhanh))
                Storage::delete($sp->hinhanh);

            $extention = $request->file('hinhanh')->extension();
            $filename = Str::slug($request->tensanpham, '-') . '.' . $extention;

            $lsp = LoaiSanPham::find($request->loaisanpham_id);
            $path = Storage::disk('public')->putFileAs($lsp->tenloai_slug, $request->file('hinhanh'), $filename);
        }


        $orm = SanPham::findOrFail($id);
        $orm->tensanpham = Str::title($request->tensanpham);
        $orm->tensanpham_slug = Str::slug($orm->tensanpham, '-');
        $orm->hinhanh = $path ?? $orm->hinhanh ?? null;
        $orm->mota = $request->mota;
        $orm->soluong = $request->soluong;
        $orm->gia = $request->gia;
        $orm->khuyenmai = $request->khuyenmai ?? 0;
        $orm->gia_khuyenmai = $request->gia - ($request->gia * $request->khuyenmai / 100);
        $orm->trangthai = $request->trangthai;
        $orm->loaisanpham_id = $request->loaisanpham_id;
        $orm->hangsanxuat_id = $request->hangsanxuat_id;
        $orm->save();

        return redirect()->route('admin.sanpham')->with('success', 'Cập nhật hãng sản xuất thành công!');
    }

    public function getXoa($id)
    {
        $orm = SanPham::find($id);
        if ($orm) {
            $orm->delete();
            return redirect()->route('admin.sanpham')->with('success', 'Xóa thành công');
        }
        return redirect()->route('admin.sanpham')->with('error', 'Lỗi khi xóa');
    }


    public function getLoc(Request $request)
    {
        // Lấy tất cả danh sách hãng, loại để hiển thị lại form
        $hangsanxuat = HangSanXuat::all();
        $loaisanpham = LoaiSanPham::all();

        // Bắt đầu query
        $query = SanPham::query();

        // Nếu có chọn hãng sản xuất
        if ($request->filled('hangsanxuat_id')) {
            $query->where('hangsanxuat_id', $request->hangsanxuat_id);
        }

        // Nếu có chọn loại sản phẩm
        if ($request->filled('loaisanpham_id')) {
            $query->where('loaisanpham_id', $request->loaisanpham_id);
        }

        if ($request->filled('kho')) {
            $kho = $request->kho;

            if ($kho == 0)
                $query->where('trangthai', 0);
            elseif ($kho == 1)
                $query->where('trangthai', 1);
            elseif ($kho == 2)
                $query->where('trangthai', 2);
        }

        // Lấy kết quả
        $sanpham = $query->get();

        // Trả về view
        return view('admin.sanpham.danhsach', compact('sanpham', 'hangsanxuat', 'loaisanpham'));
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
            Excel::import(new SanPhamImxport(), $request->file('file_excel'));
            return redirect()->route('admin.sanpham')->with('success', 'Nhập dữ liệu thành công!');
        } catch (Exception $e) {

            return redirect()->route('admin.sanpham')->with('error', 'File Excel không hợp lệ hoặc bị lỗi!');
        }
    }

    public function getXuat()
    {
        return Excel::download(new SanPhamExport(), 'san-pham.xlsx');
    }

}
