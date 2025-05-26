<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table = 'productimages';
    protected $primaryKey = 'productimageid';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'productid',
        'image_path',
        'is_thumbnail',
        'caption',
    ];

    public function product()
    {
        return $this->belongsTo(ProductCollection::class, 'productid', 'productid');
    }
}
