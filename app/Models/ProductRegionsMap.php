<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductRegionsMap extends Model
{
    // Nama tabel (jika tidak mengikuti konvensi jamak)
    protected $table = 'productregionsmap';

    // Primary key custom
    protected $primaryKey = 'productregionsid';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'productregionscode',
        'productregionsname',
    ];

    // Jika primary key bukan incrementing integer (misal string), set false
    public $incrementing = true;

    // Jika primary key bukan tipe int, set type-nya (tidak perlu di sini karena sudah int)
    protected $keyType = 'int';
}