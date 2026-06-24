<?php

// 1. Muat Autoload Vendor
require __DIR__ . '/../vendor/autoload.php';

// 2. Hidupkan Aplikasi Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. Bangun HTTP Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// 4. Tangkap HTTP Request
$request = Illuminate\Http\Request::capture();

// 5. Eksekusi Request Lewat Kernel (Ini otomatis men-handle bootstrap luar dalam)
$response = $kernel->handle($request);

// 6. Kirim Response ke Browser
$response->send();

// 7. Matikan Proses Kernel
$kernel->terminate($request, $response);