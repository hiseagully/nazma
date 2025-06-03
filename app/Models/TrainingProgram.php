<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    protected $table = 'trainingprogram';
    protected $primaryKey = 'trainingid';
    public $timestamps = true;

    protected $fillable = [
        'trainingregionid',
        'trainingtitle',
        'trainingdescription',
        'trainingpricerupiah',
        'trainingpricedollar',
        'trainingimage',
        'trainingschedule',
        'traininglocation',
        'trainingslot',
    ];

    // Relasi ke TrainingRegion
    public function region()
    {
        return $this->belongsTo(TrainingRegion::class, 'trainingregionid', 'trainingid');
    }
}