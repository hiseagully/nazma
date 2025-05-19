<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingRegion extends Model
{
    protected $table = 'trainingregions';
    protected $primaryKey = 'trainingid';

    public $timestamps = true;           // Karena pakai timestamps()
    public $incrementing = true;         // Auto increment
    protected $keyType = 'int';          // Auto-increment berarti integer

    protected $fillable = [
        'trainingregionname',
    ];
}
