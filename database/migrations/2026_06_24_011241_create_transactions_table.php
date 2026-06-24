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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('ormawa_id')->constrained('ormawas')->onDelete('cascade'); // Menghubungkan transaksi ke ormawa tertentu
        $table->date('tanggal');
        $table->string('keterangan');
        $table->enum('jenis', ['masuk', 'keluar']); // Pilih salah satu: kas masuk atau kas keluar
        $table->decimal('nominal', 15, 2); // Menggunakan decimal agar perhitungan uang presisi (max 99 triliun, 2 angka di belakang koma)
        $table->string('bukti_nota')->nullable(); // Menyimpan nama file foto/PDF kuitansi (nullable artinya boleh kosong dulu)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
