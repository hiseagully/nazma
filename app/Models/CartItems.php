<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    protected $table = 'cartitems';
    protected $primaryKey = 'id';
    protected $fillable = ['cart_id', 'productid', 'quantity'];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(ProductCollection::class, 'productid', 'productid');
    }
}