<?php

// 1. Muat autoload vendor
require __DIR__ . '/../vendor/autoload.php';

// 2. Hidupkan aplikasi Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. Tangkap HTTP Request di awal agar objek 'request' terdaftar di sistem Laravel
$request = Illuminate\Http\Request::capture();
$app->instance('request', $request);

// 4. Daftarkan dan hidupkan bootstrap kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// 5. Jalankan pengerjaan request
$response = $kernel->handle($request);

$response->send();

$kernel->terminate($request, $response);