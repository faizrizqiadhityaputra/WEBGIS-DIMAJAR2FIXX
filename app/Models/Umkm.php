<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class Umkm extends Model
{
    use SpatialTrait;

    protected $table = 'umkm';
    public $timestamps = false;

    protected $spatialFields = [
        'geom',
    ];

    protected $fillable = [
        'nama_umkm', 'jenis_umkm', 'nama_pemilik', 'geom'
    ];
}
