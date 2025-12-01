<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class DonHang extends Model
{
    protected $table = 'DonHang';
    protected $fillable = [
        'user_id',
        'tinhtrang_id',
        'sodienthoai',
        'diachi',
    ];
    public function tinhtrang()
    {
        return $this->belongsTo(TinhTrang::class, 'tinhtrang_id');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function donhang_chitiet(): HasMany
    {
        return $this->hasMany(DonHangChiTiet::class, 'donhang_id');
    }

}
