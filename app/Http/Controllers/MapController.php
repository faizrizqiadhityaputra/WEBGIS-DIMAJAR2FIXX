<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bangunan;
use App\Models\Umkm;
use App\Models\SumberAir;

class MapController extends Controller
{
    // Fungsi untuk memuat halaman utama WebGIS
    public function index()
    {
        return view('map'); // Kita akan membuat file resources/views/map.blade.php setelah ini
    }

    // Mengambil data Bangunan (untuk Kepadatan Hunian & Daya Listrik)
    public function getBangunan()
    {
        $data = Bangunan::all();
        return response()->json($this->toGeoJson($data));
    }

    // Mengambil data UMKM
    public function getUmkm()
    {
        $data = Umkm::all();
        return response()->json($this->toGeoJson($data));
    }

    // Mengambil data Sumber Air Bersih
    public function getSumberAir()
    {
        $data = SumberAir::all();
        return response()->json($this->toGeoJson($data));
    }

    /**
     * Fungsi Helper (Bantuan) untuk mengubah koleksi Eloquent menjadi format GeoJSON standar
     */
    private function toGeoJson($data)
    {
        $features = [];

        foreach ($data as $row) {
            // Memastikan data memiliki geometri yang tidak kosong
            if ($row->geom) {
                // Ambil semua kolom sebagai properties, kecuali kolom 'geom'
                $properties = $row->toArray();
                unset($properties['geom']);

                $features[] = [
                    'type' => 'Feature',
                    // Paket Grimzy Spatial memungkinkan kita men-decode objek geom menjadi JSON
                    'geometry' => json_decode($row->geom->toJson()),
                    'properties' => $properties,
                ];
            }
        }

        return [
            'type' => 'FeatureCollection',
            'features' => $features,
        ];
    }
}
