<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pesanan_makanans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('daftar_menu');         // ubah ke format snake_case
            $table->integer('jumlah_menu');
            $table->text('catatan_tambahan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_makanans');
    }
};
