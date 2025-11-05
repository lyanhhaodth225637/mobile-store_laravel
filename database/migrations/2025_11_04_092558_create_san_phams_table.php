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
            $table->string('tensanpham');
            $table->string('tensanpham_slug');
            $table->decimal('gia');
            $table->integer('soluong');
            $table->date('ngayban')->nullable();
            $table->text('mota')->nullable();
            $table->string('hinhanh')->nullable();
            $table->json('ram')->nullable();
            $table->enum('trangthai', [0,1,2])->default(0);// 0: hết hàng, 1: còn hàng, 2: đặt trước

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};
