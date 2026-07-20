<?php

// --- TAMBAHKAN 2 BARIS INI UNTUK MEMAKSA HAPUS CACHE DI VERCEL ---
array_map('unlink', glob(__DIR__ . '/../bootstrap/cache/*.php'));
putenv('APP_CONFIG_CACHE=/tmp/config.php');
// -----------------------------------------------------------------

require __DIR__ . '/../public/index.php';
