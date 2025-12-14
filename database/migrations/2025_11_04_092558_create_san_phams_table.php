<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loaisanpham_id')->constrained('loaisanpham');
            $table->foreignId('hangsanxuat_id')->constrained('hangsanxuat');
            $table->string('hinhanh')->nullable();
            $table->string('tensanpham');
            $table->string('tensanpham_slug')->unique();
            $table->text('mota')->nullable();
            $table->json('thongso')->nullable();
            $table->integer('soluong');
            $table->double('gia');
            $table->tinyInteger('khuyenmai')->default(0);
            $table->double('gia_khuyenmai')->nullable();
            $table->integer('daban')->default(0);
            $table->tinyInteger('trangthai')->default(0);//0 hết, 1 đang bán, 2 đặt trước
            $table->integer('luotxem')->default(0);
            $table->boolean('noibat')->default(false);
            $table->integer('sl_dat_truoc')->default(0);
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};
