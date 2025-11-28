<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
    public function getDanhSach()
    {
        $user = User::orderBy('role', 'asc')->orderBy('created_at', 'desc')->get();
        return view('admin.user.danhsach', compact('user'));
    }
    public function getKhachHang_Moi()
    {
        $user = User::where('role', '2')->where('points', '>', '0')->where('points', '<=', '100')
            ->get();
        return view('admin.user.khachhang_moi', compact('user'));
    }
    public function getKhachHang_ThanThiet()
    {
        $user = User::where('role', '2')->where('points', '>', '100')->where('points', '<=', '500')
            ->get();
        return view('admin.user.khachhang_thanthiet', compact('user'));
    }
    public function getKhachHang_VIP()
    {
        $user = User::where('role', '2')->where('points', '>', '1000')
            ->get();
        return view('admin.user.khachhang_vip', compact('user'));
    }

    public function getThem()
    {
        return view('admin.user.them');
    }

    public function postThem(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'username' => ['nullable', 'string', 'max:255', 'unique:users,username'],
            'role' => ['required', 'integer', 'min:0', 'max:2'],
            'points' => ['nullable', 'integer', 'min:0'],
            'password' => ['required', 'string', 'min:8',],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
        ]);

        $path = null;
        if ($request->hasFile('hinhanh')) {
            $extention = $request->file('hinhanh')->extension();
            $filename = Str::slug($request->name, '-') . '.' . $extention;
            $path = Storage::disk('public')->putFileAs('anh-dai-dien', $request->file('hinhanh'), $filename);
        }

        // Khởi tạo ORM giống mẫu bạn đưa
        $orm = new User();
        $orm->name = Str::title($request->name);
        $orm->name_slug = Str::slug($orm->name, '-');
        $orm->email = Str::before($request->email, '@');
        $orm->username = $request->username;
        $orm->role = $request->role ?? 1;
        $orm->points = 0; // mặc định
        $orm->password = Hash::make($request->password);
        $orm->hinhanh = $path ?? 'anh-dai-dien/default.png';
        $orm->email_verified_at = null;

        $orm->save();

        return redirect()->back()->with('success', 'Thêm người dùng thành công!');
    }

    public function getSua($id)
    {
        $user = User::find($id);
        return view('admin.user.sua', compact('user'));
    }

    public function postSua(Request $request, $id)
    {
        $orm = User::findOrFail($id);

        // Validate
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id)],
            'role' => ['required'],
            'password' => ['nullable', 'string', 'min:8'],
            'hinhanh' => ['nullable', 'image', 'max:2048'],
        ]);

        // Lưu email cũ để kiểm tra
        $oldEmail = $orm->email;

        // Ảnh đại diện
        $path = $orm->hinhanh;

        if ($request->hasFile('hinhanh')) {

            // Xóa file cũ
            if ($orm->hinhanh && Storage::disk('public')->exists($orm->hinhanh)) {
                Storage::disk('public')->delete($orm->hinhanh);
            }

            $ext = $request->file('hinhanh')->extension();
            $filename = Str::slug($request->name, '-') . '.' . $ext;

            $path = Storage::disk('public')->putFileAs(
                'anh-dai-dien',
                $request->file('hinhanh'),
                $filename
            );
        }

        // Cập nhật dữ liệu
        $orm->name = Str::title($request->name);
        $orm->name_slug = Str::slug($orm->name, '-');
        $orm->username = $request->username;
        $orm->role = $request->role;

        // Reset email_verified_at nếu đổi email
        if ($request->email !== $oldEmail) {
            $orm->email_verified_at = null;
        }

        $orm->email = $request->email;
        $orm->hinhanh = $path;

        // Đổi mật khẩu nếu có nhập
        if ($request->filled('password')) {
            $orm->password = Hash::make($request->password);
        }

        $orm->save();

        return redirect()->back()->with('success', 'cập nhật dùng thành công!');
    }








    public function getLoc(Request $request)
    {
        $orm = User::query();
        if ($request->filled('vaitro')) {
            $vaitro = $request->vaitro;

            if ($vaitro == 0)
                $orm->where('role', 0);
            elseif ($vaitro == 1)
                $orm->where('role', 1);
            elseif ($vaitro == 2)
                $orm->where('role', 2);
        }
        $user = $orm->get();
        return view('admin.user.danhsach', compact('user'));
    }

    public function getXoa($id)
    {
        $orm = User::find($id);
        if ($orm) {
            $orm->delete();
            return redirect()->route('admin.user')->with('success', 'Xóa thành công');

        }
        return redirect()->route('admin.user')->with('error', 'Lỗi khi xóa');

    }
}
