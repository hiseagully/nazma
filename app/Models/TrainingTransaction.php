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
        'transactiontraineeemail',
        'transactiontraineename',
        'transactiontraineeage',
        'transactiontraineegender',
        'transactiontraineeaddress',
        'payment_method',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function training()
    {
        return $this->belongsTo(TrainingProgram::class, 'trainingid', 'trainingid');
    }
}