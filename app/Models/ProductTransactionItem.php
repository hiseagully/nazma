<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTransactionItem extends Model
{
    protected $table = 'producttransactionitems';

    public function transaction()
    {
        return $this->belongsTo(ProductTransaction::class, 'transaction_id');
    }

    public function product()
    {
        return $this->belongsTo(ProductCollection::class, 'product_id', 'productid');
    }
}