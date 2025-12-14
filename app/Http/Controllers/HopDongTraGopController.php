<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HopDongTraGop;

class HopDongTraGopController extends Controller
{
    public function getDanhSach()
    {
        $hopdong = HopDongTraGop::latest()->get();


        return view('admin.hopdongtragop.danhsach', compact('hopdong'));
    }

    public function postDuyet(Request $request, $id)
    {
        try {
            $hopdong = HopDongTraGop::findOrFail($id);

            // Validate
            $request->validate([
                'duyet' => 'required|in:1,2'
            ]);

            // Cập nhật trạng thái duyệt
            $hopdong->duyet = $request->duyet;
            $hopdong->save();

            $message = $request->duyet == 1 ? 'Đã duyệt hợp đồng thành công!' : 'Đã từ chối hợp đồng!';

            return redirect()->back()->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }


    public function getLoc(Request $request)
    {
        $trangthai = $request->input('hopdong'); 

        if ($trangthai !== null && $trangthai !== '') {
            $hopdong = HopDongTraGop::where('duyet', $trangthai)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $hopdong = HopDongTraGop::orderBy('id', 'desc')->get();
        }

        return view('admin.hopdongtragop.danhsach', compact('hopdong'));
    }

}
