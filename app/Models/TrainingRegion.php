<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingRegion extends Model
{
    protected $table = 'trainingregions';
    protected $primaryKey = 'trainingid';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['trainingregionname'];

    public static $rules = [
        'trainingregionid' => 'required|exists:trainingregions,trainingid',
    ];
}
