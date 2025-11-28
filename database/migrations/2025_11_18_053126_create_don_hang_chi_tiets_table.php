<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('donhang_chitiet', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donhang_id')->constrained('donhang');
            $table->foreignId('sanpham_id')->constrained('sanpham');
            $table->integer('soluong');
            $table->double('dongia');
            $table->string('mota')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donhang_chitiet');
    }
};
