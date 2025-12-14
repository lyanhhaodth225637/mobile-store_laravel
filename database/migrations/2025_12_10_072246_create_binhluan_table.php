<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void
    {
        Schema::create('binhluan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sanpham_id')->constrained('sanpham')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->tinyInteger('danhgia')->default(5);
            $table->text('noidung');
            $table->integer('like_count')->default(0);
            $table->integer('dislike_count')->default(0);
            $table->timestamps();

            $table->index('parent_id');
            $table->foreign('parent_id')->references('id')->on('binhluan')->onDelete('cascade');
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('binhluan');
    }
};
