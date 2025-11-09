<?php

namespace App\Imports;

use App\Models\SanPham;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SanPhamImxport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        $sp = SanPham::where('tensanpham', $row['tensanpham'])->first();
        if ($sp)
            return null;
        // Không cần kiểm tra trùng tên nữa nếu bạn cho phép import rỗng
        return new SanPham([
            'loaisanpham_id' => $row['loaisanpham_id'] ?? null,
            'hangsanxuat_id' => $row['hangsanxuat_id'] ?? null,
            'tensanpham' => $row['tensanpham'] ?? null,
            'tensanpham_slug' => $row['tensanpham_slug'] ?? null,
            'soluong' => $row['soluong'] ?? null,
            'gia' => $row['gia'] ?? null,
            'khuyenmai' => $row['khuyenmai'] ?? 0,
            'gia_khuyenmai' => isset($row['gia'], $row['khuyenmai'])
                ? $row['gia'] - ($row['gia'] * $row['khuyenmai'] / 100)
                : null,
            'mota' => $row['mota'] ?? null,
            'hinhanh' => $row['hinhanh'] ?? null,
        ]);
    }

}
