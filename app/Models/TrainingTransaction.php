<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingTransaction extends Model
{
    protected $table = 'trainingtransaction';
    protected $primaryKey = 'trainingtransactionid';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'trainingtransactionmethod',
        'trainingtransactionstatus',
        'trainingtransactiondate',
        'trainingtransactiontotal',
        'transactiontraineegender',
        'transactiontraineename',
        'transactiontraineeage',
        'transactiontraineeaddress',
        'user_id',
        'trainingid',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Relasi ke TrainingProgram
    public function trainingProgram()
    {
        return $this->belongsTo(TrainingProgram::class, 'trainingid', 'trainingid');
    }
}