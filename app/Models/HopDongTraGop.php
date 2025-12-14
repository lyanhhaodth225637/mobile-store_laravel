<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class HopDongTraGop extends Model
{
    protected $table = 'hopdong_tragop';

    protected $fillable = [
        'user_id',
        'sanpham_id',
        'thoi_han',
        'tra_truoc',
        'gia_san_pham',
        'so_tien_tra_truoc',
        'so_tien_con_lai',
        'lai_suat_hang_thang',
        'so_tien_tra_moi_thang',
        'ho_ten',
        'cccd',
        'dia_chi',
        'sdt',
        'tinh_trang_hop_dong',
        'duyet'

    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sanpham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'sanpham_id');
    }
}
