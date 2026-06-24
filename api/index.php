<?php

// 1. Muat autoload vendor
require __DIR__ . '/../vendor/autoload.php';

// 2. Hidupkan aplikasi Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. Paksa aplikasi untuk memuat semua service provider dasar (View, Session, dll)
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// 4. Jalankan HTTP Kernel seperti biasa
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);