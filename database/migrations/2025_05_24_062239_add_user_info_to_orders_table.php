<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->string('name')->after('user_id');
        $table->string('email')->after('name');
        $table->string('phone')->after('email');
        $table->string('address')->after('phone');
        $table->enum('status', ['pending', 'completed'])->default('pending')->after('payment_method');
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn(['name', 'email', 'phone', 'address', 'status']);
    });
}
};
