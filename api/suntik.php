<?php
header('Content-Type: text/plain');

// MASUKKAN DATA SUPABASE LU DI SINI
$host     = 'aws-0-ap-southeast-1.pooler.supabase.com'; 
$db       = 'postgres';                                 
$user     = 'postgres';                                 
$password = 'PASSWORD_SUPABASE_LU'; // Ganti pake password lu
$port     = '6543';

// 🔍 CARI PROJECT REF LU (Ada di URL Dashboard Supabase lu, misal: abcdefghijklmnopqrst)
// URL Supabase biasanya: https://supabase.com/dashboard/project/abcdefghijklmnopqrst
$project_ref = 'ID_PROJECT_SUPABASE_LU_DI_SINI'; 

echo "🔌 Mencoba menyambung dengan Trik Injeksi Tenant...\n";

try {
    // 🔥 KUNCI UTAMA: Kita tambahkan options=project=project_ref ke dalam DSN!
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;options='--project=$project_ref'";
    
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    echo "✅ KONEKSI 100% SUKSES TEMBUS SUPABASE!\n\n";
    echo "🔥 BOOM! Database SIM-ORMAWA Berhasil Disuntik Online via PDO Injeksi!\n";
    
} catch (\PDOException $e) {
    echo "🚨 GAGAL KONEKSI DATABASE:\n" . $e->getMessage() . "\n";
}