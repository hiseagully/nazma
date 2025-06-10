<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingTransaction extends Model
{
    protected $table = 'trainingtransaction'; // nama tabel sesuai di database
    protected $primaryKey = 'trainingtransactionid'; // sesuaikan

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'trainingid',
        'transactiontraineename',
        'transactiontraineeage',
        'transactiontraineegender',
        'transactiontraineeaddress',
        'trainingtransactionmethod',
        'trainingtransactionstatus',
        'trainingtransactiondate',
        'trainingtransactiontotal',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function training() {
        return $this->belongsTo(TrainingProgram::class, 'trainingid', 'trainingid');
    }
}