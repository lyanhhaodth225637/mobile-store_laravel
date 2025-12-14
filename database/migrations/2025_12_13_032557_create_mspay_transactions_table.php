<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   
    public function up(): void
    {
        Schema::create('mspay_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('donhang_id') ->nullable() ->constrained('donhang')->nullOnDelete();
            $table->enum('loai_giao_dich', ['nap_tien', 'thanh_toan', 'hoan_tien']);
            $table->decimal('so_tien', 15, 0);
            $table->decimal('so_du_truoc', 15, 0);
            $table->decimal('so_du_sau', 15, 0);
            $table->string('mo_ta')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('mspay_transactions');
    }
};
