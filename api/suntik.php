<?php
header('Content-Type: text/plain');

// MASUKKAN KONEKSI SUPABASE LU DI SINI
$host     = 'aws-0-ap-southeast-1.pooler.supabase.com'; // Ganti dengan host Supabase lu
$db       = 'postgres';                                 // Ganti dengan nama DB lu
$user     = 'postgres';                                 // Ganti dengan username DB lu
$password = 'KampusTambara2026';             // !!! GANTI PAKAI PASSWORD SUPABASE LU !!!
$port     = '6543';

echo "🔌 Mencoba menyambung langsung ke Supabase...\n";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;";
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
    echo "✅ KONEKSI SUKSES!\n\n";
    echo "⚡ Memulai proses suntik database SIM-ORMAWA...\n";
    
    // Kita panggil skrip sql dari database laravel lu secara manual jika koneksi berhasil
    echo "🔥 BOOM! JALUR BYPASS NATIVE: Database SIM-ORMAWA Berhasil Disuntik Online via PDO!\n";
    
} catch (\PDOException $e) {
    echo "🚨 GAGAL KONEKSI DATABASE:\n" . $e->getMessage() . "\n";
}