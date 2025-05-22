<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCatalog extends Model
{
    protected $table = 'productcatalog';
    protected $primaryKey = 'productcatalogid';
    protected $fillable = [
        'productcatalogimage',
        'productcatalogname',
    ];
    public $incrementing = true;
    protected $keyType = 'int';
    public function getRouteKeyName()
    {
        return 'productcatalogid';
    }
}
