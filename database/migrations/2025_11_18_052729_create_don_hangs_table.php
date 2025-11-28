<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('donhang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('tinhtrang_id')->constrained('tinhtrang');
            $table->string('sodienthoai', 20);
            $table->string('diachi');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('donhang');
    }
};
