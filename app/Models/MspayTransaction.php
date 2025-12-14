<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MspayTransaction extends Model
{
    use HasFactory;

    protected $table = 'mspay_transactions';

    protected $fillable = [
        'user_id',
        'donhang_id',
        'loai_giao_dich',   
        'so_tien',
        'so_du_truoc',
        'so_du_sau',
        'mo_ta',
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

  
    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'donhang_id', 'id');
    }
}
