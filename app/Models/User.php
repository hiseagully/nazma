<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users'; // Nama tabel

    protected $primaryKey = 'user_id'; // Ganti dengan nama primary key kamu

    public $incrementing = true; // atau false jika bukan auto increment

    protected $keyType = 'int'; // atau 'string' jika tipe string

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_name',
        'user_email',
        'user_password',
        'user_phone',
        'role',
        'district_code',
        'district_name',
        'full_address',
    ];

    protected $hidden = [
        'user_password',
    ];

    // Override agar Auth pakai kolom yang benar
    public function getAuthPassword()
    {
        return $this->user_password;
    }

    public function getEmailForPasswordReset()
    {
        return $this->user_email;
    }

    // Relasi ke cart
    public function cart()
    {
        return $this->hasOne(\App\Models\Carts::class, 'user_id', 'user_id');
    }
}