<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('mspay_balance', 15, 0)->default(0)->after('password');
            $table->string('mspay_pin')->nullable()->after('mspay_balance');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mspay_balance', 'mspay_pin']);
        });
    }

};
