<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('ma_voucher')->unique();
            $table->integer('diem_can_doi');    // điểm cần để đổi voucher
            $table->integer('gia_tri');         // số tiền giảm
            $table->integer('so_luong')->default(1);
            $table->date('het_han');            // ngày hết hạn
            $table->boolean('trang_thai')->default(1); // 1: còn dùng, 0: hết hạn
            $table->string('mo_ta')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
