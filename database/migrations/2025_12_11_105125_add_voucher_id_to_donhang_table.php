<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('donhang', function (Blueprint $table) {
            $table->unsignedBigInteger('voucher_id')->nullable()->after('VAT');
        });
    }

    public function down(): void
    {
        Schema::table('donhang', function (Blueprint $table) {
            $table->dropColumn('voucher_id');
        });
    }
};
