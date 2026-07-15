<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Bangunan extends Model
{
    use SpatialTrait;

    protected $table = 'bangunan';

    // Karena kita tidak memakai timestamps (created_at, updated_at) di PostGIS
    public $timestamps = false;

    // Mendefinisikan kolom yang berisi data geometri/spasial
    protected $spatialFields = [
        'geom',
    ];

    protected $fillable = [
        'id_bangunan', 'rt', 'rw', 'jml_kk', 'jml_anggota', 'daya_listrik', 'kondisi_bangunan', 'geom'
    ];
}
