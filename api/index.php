<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Folder storage sementara untuk Vercel
$tmpStorage = '/tmp/storage';

if (! is_dir($tmpStorage.'/framework/views')) {
    mkdir($tmpStorage.'/framework/views', 0777, true);
}

if (! is_dir($tmpStorage.'/framework/cache')) {
    mkdir($tmpStorage.'/framework/cache', 0777, true);
}

if (! is_dir($tmpStorage.'/framework/sessions')) {
    mkdir($tmpStorage.'/framework/sessions', 0777, true);
}

if (! is_dir($tmpStorage.'/logs')) {
    mkdir($tmpStorage.'/logs', 0777, true);
}

// Maintenance mode
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Composer
require __DIR__.'/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// Pindahkan storage ke /tmp
$app->useStoragePath($tmpStorage);

// Jalankan Laravel
$app->handleRequest(Request::capture());
