<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCollection extends Model
{
    protected $table = 'productcollection';
    protected $primaryKey = 'productid';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'productcatalogid',
        'productregionsid',
        'productname',
        'productdescription',
        'productpricerupiah',
        'productpricedollar',
        'productweight',
        'productstock',
    ];

    public function catalog()
    {
        return $this->belongsTo(ProductCatalog::class, 'productcatalogid', 'productcatalogid');
    }

    public function region()
    {
        return $this->belongsTo(ProductRegionsMap::class, 'productregionsid', 'productregionsid');
    }

    public function images()
    {
        return $this->hasMany(\App\Models\ProductImages::class, 'productid', 'productid');
    }
}