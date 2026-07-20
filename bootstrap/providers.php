<?php

use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,

    // Didaftarkan manual karena package auto-discovery Laravel gagal
    // menulis cache manifest di lingkungan serverless Vercel (filesystem read-only).
    Illuminate\View\ViewServiceProvider::class,
    Illuminate\Session\SessionServiceProvider::class,
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Cookie\CookieServiceProvider::class,
    Illuminate\Database\DatabaseServiceProvider::class,
    Illuminate\Encryption\EncryptionServiceProvider::class,
    Illuminate\Filesystem\FilesystemServiceProvider::class,
    Illuminate\Hashing\HashServiceProvider::class,
    Illuminate\Pagination\PaginationServiceProvider::class,
    Illuminate\Translation\TranslationServiceProvider::class,
    Illuminate\Validation\ValidationServiceProvider::class,
];
