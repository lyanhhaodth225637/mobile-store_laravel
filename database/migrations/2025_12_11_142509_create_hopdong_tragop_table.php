<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('hopdong_tragop', function (Blueprint $table) {
            $table->id();
        
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sanpham_id');

        
            $table->integer('thoi_han');
            $table->integer('tra_truoc'); 
            $table->decimal('gia_san_pham', 15, 2);
            $table->decimal('so_tien_tra_truoc', 15, 2);
            $table->decimal('so_tien_con_lai', 15, 2);
            $table->decimal('lai_suat_hang_thang', 5, 2)->default(1.2);
            $table->decimal('so_tien_tra_moi_thang', 15, 2);

     
            $table->string('ho_ten');
            $table->string('cccd');
            $table->string('dia_chi');
            $table->string('sdt');

           
            $table->tinyInteger('trang_thai_hop_dong')->default(0);
     
            $table->tinyInteger('duyet')->default(1);
      
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hopdong_tragop');
    }
};
