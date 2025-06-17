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
       Schema::create('detailreservasis', function (Blueprint $table) {
        $table->id();
        $table->dateTime('tanggal_waktu');   // <-- pastikan ini ada
        $table->string('lokasi');
        $table->string('jenis_layanan');
        $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_reservasis');
    }
};
