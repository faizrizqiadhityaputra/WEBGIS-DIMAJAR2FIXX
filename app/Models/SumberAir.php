<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

class SumberAir extends Model
{
    use SpatialTrait;

    protected $table = 'sumber_air';
    public $timestamps = false;

    protected $spatialFields = [
        'geom',
    ];

    protected $fillable = [
        'jenis_sumber', 'kondisi_air', 'geom'
    ];
}
