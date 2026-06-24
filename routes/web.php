<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController; // Taruh ini di baris paling atas dekat "use Illuminate\Support\Facades\Route;"

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [TransactionController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// Tambahkan 2 baris ini:
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/print', [TransactionController::class, 'print'])->name('transactions.print');
});

require __DIR__.'/auth.php';
```php
Route::get('/gas-db', function () {
    try {
        // Paksa jalankan migrasi di lingkungan production
        \Artisan::call('migrate:fresh', [
            '--seed' => true,
            '--force' => true,
        ]);
        return "🔥 BOOM! Database SIM-ORMAWA Berhasil Disuntik Online!";
    } catch (\Exception $e) {
        // Kalau gagal, tampilkan eror aslinya di browser biar kita tahu penyebabnya
        return "Waduh Eror Koneksi Database, Bro: <br><pre>" . $e->getMessage() . "</pre>";
    }
});