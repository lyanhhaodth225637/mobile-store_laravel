<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SanPham extends Model
{
    protected $table = 'sanpham';
    protected $fillable = [
        'loaisanpham_id',
        'hangsanxuat_id',
        'hinhanh',
        'tensanpham',
        'tensanpham_slug',
        'mota',
        'thongso',
        'soluong',
        'gia',
        'khuyenmai',
        'gia_khuyenmai',
        'trangthai',
        'luotxem',
        'noibat',
        'dat_truoc',
    ];

    protected $casts = [
        'thongso' => 'array',
    ];

    public function HangSanXuat(): BelongsTo
    {
        return $this->belongsTo(HangSanXuat::class, 'hangsanxuat_id', 'id');
    }

    public function LoaiSanPham(): BelongsTo
    {
        return $this->belongsTo(LoaiSanPham::class, 'loaisanpham_id', 'id');
    }
    public function ratings()
    {
        return $this->hasMany(BinhLuan::class, 'sanpham_id', 'id');
    }


}
