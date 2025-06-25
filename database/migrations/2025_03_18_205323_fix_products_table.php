<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Hapus kolom 'category' jika ada (harus hati-hati, pastikan sudah backup data)
            if (Schema::hasColumn('products', 'category')) {
                $table->dropColumn('category');
            }

            // Ubah kolom category_id jadi nullable
            $table->unsignedBigInteger('category_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category')->nullable(); // Kembalikan kolom kategori (jika rollback)
            $table->unsignedBigInteger('category_id')->nullable(false)->change();
        });
    }
};
