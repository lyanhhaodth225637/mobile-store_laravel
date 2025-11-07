<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loaisanpham_id');
            $table->foreignId('hangsanxuat_id');
            $table->string('hinhanh')->nullable();
            $table->string('tensanpham');
            $table->string('tensanpham_slug')->unique();
            $table->text('mota')->nullable();
            $table->integer('soluong');
            $table->decimal('gia', 15, 2);
            $table->tinyInteger('khuyenmai')->default(0);
            $table->decimal('gia_khuyenmai', 15, 2)->nullable();
            $table->tinyInteger('trangthai')->default(0);//0 hết, 1 đang bán, 2 đặt trước
            $table->integer('luotxem')->default(0);
            $table->boolean('noibat')->default(false);
            $table->boolean('dat_truoc')->default(false);
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};
