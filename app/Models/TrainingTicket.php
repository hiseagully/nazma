<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingTicket extends Model
{
    protected $table = 'trainingticket'; // nama tabel di database
    protected $primaryKey = 'trainingticketid'; // sesuaikan dengan primary key kamu
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        // tambahkan field yang bisa diisi
        'user_id',
        'trainingid',
        'ticket_code',
        'status',
        // tambahkan field lain sesuai tabel
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Relasi ke Training
    public function training()
    {
        return $this->belongsTo(TrainingProgram::class, 'trainingid', 'trainingid');
    }
}
