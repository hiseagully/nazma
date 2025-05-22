<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRegionsMap extends Model
{
    protected $table = 'productregionsmap';
    protected $primaryKey = 'productregionsid';
    protected $fillable = [
        'productregionscode',
        'productregionsname',
    ];
    public $incrementing = true;
    protected $keyType = 'int';
    public function getRouteKeyName()
    {
        return 'productregionsid';
    }
}