<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voucher extends Model
{
    protected $table = 'vouchers';
    protected $fillable = [
        'ma_voucher',
        'diem_can_doi',
        'gia_tri',
        'so_luong',
        'het_han',
        'trang_thai'
    ];

    // Một voucher có thể được nhiều user đổi
    public function user_vouchers(): HasMany
    {
        return $this->hasMany(UserVoucher::class, 'voucher_id', 'id');
    }

    // Thêm method để tính used_count (số lượng đã sử dụng)
    // public function getUsedCountAttribute()
    // {
    //     return $this->user_vouchers()->count();
    // }
}