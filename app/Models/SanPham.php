<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SanPham extends Model
{
    protected $table = 'sanpham';

    public function HangSanXuat(): BelongsTo{
        //1 hãng sản xuất có n sản phân (1-n)
        return $this->belongsTo(HangSanXuat::class,'hangsanxuat_id','id');
    }

    public function LoaiSanPham() : BelongsTo {
        return $this->belongsTo(LoaiSanPham::class, 'loaisanpham_id','id');
    }
}
