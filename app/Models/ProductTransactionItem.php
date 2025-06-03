<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTransactionItem extends Model
{
    protected $table = 'producttransactionitems';

    protected $fillable = [
        'transaction_id', 'product_id', 'product_name', 'qty', 'price', 'subtotal'
    ];

    public function transaction()
    {
        return $this->belongsTo(ProductTransaction::class, 'transaction_id');
    }

    public function product()
    {
        return $this->belongsTo(ProductCollection::class, 'product_id', 'productid');
    }
}