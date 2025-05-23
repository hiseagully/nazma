<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'productid';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'productcatalogid',
        'productregionid',
        'productname',
        'productdescription',
        'productpricerupiah',
        'productpricedollar',
        'productimage',
        'productweight',
        'productstock',
    ];

    public function catalog()
    {
        return $this->belongsTo(ProductCatalog::class, 'productcatalogid', 'productcatalogid');
    }

    public function region()
    {
        return $this->belongsTo(ProductRegionsMap::class, 'productregionid', 'productregionsid');
    }

    public function getRouteKeyName()
    {
        return 'productid';
    }
}
