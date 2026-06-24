<?php
header('Content-Type: text/plain');

// DATA ASLI SUPABASE LU (HASIL COPAS)
$host     = 'aws-1-ap-southeast-1.pooler.supabase.com'; 
$db       = 'postgres';                                 
$user     = 'postgres.breufwgraehlfeqqneoe'; // <--- ISI USERNAME BARU LU DI SINI
$password = 'KampusTambara2026';         // !!! MASUKKAN PASSWORD SUPABASE LU !!!
$port     = '5432';

echo "🔌 Mencoba menyambung lewat Jalur Pooler Resmi...\n";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;";
    
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    echo "✅ KONEKSI 100% SUKSES TEMBUS KE SUPABASE!\n\n";
    echo "🔥 BOOM! Username Baru Berhasil Menjebol Pertahanan Supabase!\n";
    
} catch (\PDOException $e) {
    echo "🚨 GAGAL KONEKSI DATABASE:\n" . $e->getMessage() . "\n";
}
// Pancing build ulang Vercel sukses