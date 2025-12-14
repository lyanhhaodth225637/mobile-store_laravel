<?php

namespace App\Http\Controllers;

use App\Models\TinhTrang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
            'tinhtrang' => ['required', 'string', 'max:255', 'unique:loaisanpham,tenloai'],
        ]);

        $orm = new TinhTrang();
        $orm->tinhtrang = Str::title($request->tinhtrang);
        $orm->save();

        return redirect()->route('admin.tinhtrang')->with('success', 'Thêm tình trạng thành công!');
    }

    public function getSua($id)
    {
        $tinhtrang = TinhTrang::findOrFail($id);

        return view('admin.tinhtrang.sua', compact('tinhtrang'));
    }

    public function postSua(Request $request, $id)
    {
        $request->validate([
            'tinhtrang' => ['required', 'string', 'max:255', Rule::unique('tinhtrang', 'tinhtrang')->ignore($id)],
        ]);

        $orm = TinhTrang::findOrFail($id);
        $orm->tinhtrang = Str::title($request->tinhtrang);
        $orm->save();

        return redirect()->route('admin.tinhtrang')->with('success', 'Cập nhật tinh trang đơn hàng  thành công!');
    }

    public function getXoa($id)
    {
        $orm = TinhTrang::find($id);
        if ($orm) {
            $orm->delete();
            return redirect()->route('admin.tinhtrang')->with('success', 'Xóa thành công');
        }
        return redirect()->route('admin.tinhtrang')->with('error', 'Lỗi khi xóa');
    }
}
