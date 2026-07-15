<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;

// Rute untuk menampilkan halaman peta
Route::get('/', [MapController::class, 'index'])->name('map.index');

// Rute API Endpoint untuk menyuplai data GeoJSON ke Leaflet
Route::get('/api/bangunan', [MapController::class, 'getBangunan'])->name('api.bangunan');
Route::get('/api/umkm', [MapController::class, 'getUmkm'])->name('api.umkm');
Route::get('/api/sumber-air', [MapController::class, 'getSumberAir'])->name('api.sumber-air');
