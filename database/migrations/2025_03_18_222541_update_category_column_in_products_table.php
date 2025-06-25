<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'category')) {
                $table->dropColumn('category'); // Hapus kolom kategori yang salah jika ada
            }
            $table->foreignId('category_id')->nullable()->change(); // Pastikan category_id bisa NULL
        });
    }
    
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->nullable(); // Tambahkan kembali jika rollback
            $table->foreignId('category_id')->change();
        });
    }    
};
