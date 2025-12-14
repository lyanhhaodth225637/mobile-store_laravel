<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BinhLuanLike extends Model
{
    use HasFactory;

    protected $table = 'binhluan_like';

    protected $fillable = [
        'user_id',      // User đã like/dislike
        'binhluan_id',  // Bình luận được like/dislike
        'is_like'       // true = like, false = dislike
    ];

    /**
     * Bình luận liên kết
     */
    public function comment()
    {
        return $this->belongsTo(BinhLuan::class, 'binhluan_id');
    }

    /**
     * User đã like/dislike
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
