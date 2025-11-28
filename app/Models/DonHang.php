<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    protected $table = 'DonHang';
    protected $fillable = [
        'users_id',
        'tinhtrang_id',
        'sodienthoai',
        'diachi',
    ];
    public function TinhTrang(): BelongsTo
    {
        return $this->belongsTo('tinhtrang_id', 'id');
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function DonHang_ChiTiet(): HasMany
    {
        return $this->hasMany(DonHang_ChiTiet::class, 'donhang_id', 'id');
    }
}
