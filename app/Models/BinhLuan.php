<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BinhLuan extends Model
{
    protected $table = 'binhluan'; // <-- thêm dòng này

    protected $fillable = [
        'sanpham_id',
        'user_id',
        'parent_id',
        'danhgia',
        'noidung',
        'like_count',
        'dislike_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sanpham()
    {
        return $this->belongsTo(SanPham::class, 'sanpham_id');
    }

    public function replies()
    {
        return $this->hasMany(BinhLuan::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(BinhLuan::class, 'parent_id');
    }

    public function likes()
    {
        return $this->hasMany(BinhLuanLike::class, 'binhluan_id');
    }

    // Helper tính tổng like/dislike
    // public function likeCount()
    // {
    //     return $this->likes()->where('is_like', true)->count();
    // }

    // public function dislikeCount()
    // {
    //     return $this->likes()->where('is_like', false)->count();
    // }
}
