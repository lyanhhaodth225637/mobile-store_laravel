<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoaiSanPham extends Model
{
    protected $table = 'loaisanpham';
    public function SanPham() : HasMany{
        //1 sản phẩn thuộc 1 loại sản phẩm
        return $this->hasMany(SanPham::class, 'loaisanpham_id','id');
    }
}
