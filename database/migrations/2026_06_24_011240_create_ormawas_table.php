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
    Schema::create('ormawas', function (Blueprint $table) {
        $table->id();
        $table->string('nama_ormawa'); // Contoh: BEM, DPM, HMA
        $table->string('singkatan');    // Contoh: Badan Eksekutif Mahasiswa
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ormawas');
    }
};
