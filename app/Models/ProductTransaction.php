<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    protected $table = 'producttransactions';

    protected $fillable = [
        'user_id', 'email', 'name', 'phone', 'country', 'province_id', 'city_id', 'district_id',
        'country_name', 'city_name', 'postal_code', 'address', 'shipping_courier', 'shipping_cost',
        'payment_method', 'payment_gateway', 'payment_status', 'total_price', 'products'
    ];

    protected $casts = [
        'products' => 'array',
    ];

    // Relasi ke user (jika ada)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}